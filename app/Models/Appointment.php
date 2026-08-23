<?php
namespace App\Models;

use App\Core\Model;

class Appointment extends Model {

    public function __construct() {
        parent::__construct();
        $this->ensureSchema();
    }

    private function ensureSchema() {
        try {
            $this->db->query("SHOW COLUMNS FROM `appointments` LIKE 'booking_ref'");
            if (!$this->db->single()) {
                $this->db->query("ALTER TABLE `appointments` 
                    ADD COLUMN `booking_ref` VARCHAR(50) NULL,
                    ADD COLUMN `time_slot` ENUM('morning','afternoon') DEFAULT 'morning',
                    ADD COLUMN `queue_code` VARCHAR(20) NULL;");
                $this->db->execute();
            }
        } catch (\Exception $e) {
            error_log("Appointment schema update: " . $e->getMessage());
        }
    }
    
    public function getAll($filters = []) {
        $sql = '
            SELECT a.*, d.name as department_name, c.name as clinic_name, 
                   CONCAT(IFNULL(doc.prefix,""), IFNULL(doc.firstname,""), " ", IFNULL(doc.lastname,"")) as doctor_name
            FROM appointments a 
            LEFT JOIN departments d ON a.department_id = d.id 
            LEFT JOIN clinics c ON a.clinic_id = c.id 
            LEFT JOIN doctors doc ON a.doctor_id = doc.id
            WHERE a.deleted_at IS NULL 
        ';

        if (!empty($filters['date'])) {
            $sql .= ' AND a.appointment_date = :date';
        }
        if (!empty($filters['department_id'])) {
            $sql .= ' AND a.department_id = :dept_id';
        }
        if (!empty($filters['status'])) {
            $sql .= ' AND a.status = :status';
        }

        $sql .= ' ORDER BY a.appointment_date ASC, a.time_slot ASC, a.created_at ASC';

        $this->db->query($sql);
        if (!empty($filters['date'])) $this->db->bind(':date', $filters['date']);
        if (!empty($filters['department_id'])) $this->db->bind(':dept_id', $filters['department_id']);
        if (!empty($filters['status'])) $this->db->bind(':status', $filters['status']);

        return $this->db->resultSet() ?: [];
    }
    
    public function getById($id) {
        $this->db->query('
            SELECT a.*, d.name as department_name, c.name as clinic_name, 
                   CONCAT(IFNULL(doc.prefix,""), IFNULL(doc.firstname,""), " ", IFNULL(doc.lastname,"")) as doctor_name
            FROM appointments a 
            LEFT JOIN departments d ON a.department_id = d.id 
            LEFT JOIN clinics c ON a.clinic_id = c.id 
            LEFT JOIN doctors doc ON a.doctor_id = doc.id
            WHERE a.id = :id AND a.deleted_at IS NULL
        ');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getByBookingRef($ref) {
        $this->db->query('
            SELECT a.*, d.name as department_name, c.name as clinic_name, 
                   CONCAT(IFNULL(doc.prefix,""), IFNULL(doc.firstname,""), " ", IFNULL(doc.lastname,"")) as doctor_name
            FROM appointments a 
            LEFT JOIN departments d ON a.department_id = d.id 
            LEFT JOIN clinics c ON a.clinic_id = c.id 
            LEFT JOIN doctors doc ON a.doctor_id = doc.id
            WHERE a.booking_ref = :ref AND a.deleted_at IS NULL
        ');
        $this->db->bind(':ref', $ref);
        return $this->db->single();
    }

    /**
     * Get capacity and booking counts for a specific month
     */
    public function getMonthCapacity($year, $month, $department_id = null) {
        $startDate = sprintf('%04d-%02d-01', $year, $month);
        $endDate = date('Y-m-t', strtotime($startDate));

        $sql = '
            SELECT appointment_date, time_slot, COUNT(*) as booked_count 
            FROM appointments 
            WHERE appointment_date BETWEEN :start AND :end 
            AND status != "cancelled" 
            AND deleted_at IS NULL
        ';
        if ($department_id) {
            $sql .= ' AND department_id = :dept_id';
        }
        $sql .= ' GROUP BY appointment_date, time_slot';

        $this->db->query($sql);
        $this->db->bind(':start', $startDate);
        $this->db->bind(':end', $endDate);
        if ($department_id) {
            $this->db->bind(':dept_id', $department_id);
        }

        $results = $this->db->resultSet() ?: [];
        
        $dailyBookings = [];
        foreach ($results as $r) {
            $date = $r->appointment_date;
            if (!isset($dailyBookings[$date])) {
                $dailyBookings[$date] = [
                    'morning' => 0,
                    'afternoon' => 0,
                    'total' => 0
                ];
            }
            $dailyBookings[$date][$r->time_slot] = (int)$r->booked_count;
            $dailyBookings[$date]['total'] += (int)$r->booked_count;
        }

        return $dailyBookings;
    }

    /**
     * Generate unique booking reference and queue code
     */
    public function createSmartAppointment($data) {
        $dateStr = str_replace('-', '', $data['appointment_date']);
        
        // Count bookings today for sequential code
        $this->db->query('SELECT COUNT(*) as c FROM appointments WHERE appointment_date = :d');
        $this->db->bind(':d', $data['appointment_date']);
        $row = $this->db->single();
        $seq = ($row->count ?? $row->c ?? 0) + 1;

        $slotPrefix = ($data['time_slot'] === 'morning') ? 'M' : 'A';
        $queueCode = sprintf('Q%s-%03d', $slotPrefix, $seq);
        $bookingRef = sprintf('PDH-%s-%04d', $dateStr, rand(1000, 9999));

        $this->db->query('
            INSERT INTO appointments 
            (booking_ref, queue_code, user_id, hn_number, patient_name, phone, department_id, clinic_id, doctor_id, appointment_date, appointment_time, time_slot, symptoms, status) 
            VALUES 
            (:booking_ref, :queue_code, :user_id, :hn_number, :patient_name, :phone, :department_id, :clinic_id, :doctor_id, :appointment_date, :appointment_time, :time_slot, :symptoms, :status)
        ');
        $this->db->bind(':booking_ref', $bookingRef);
        $this->db->bind(':queue_code', $queueCode);
        $this->db->bind(':user_id', $data['user_id'] ?? null);
        $this->db->bind(':hn_number', $data['hn_number'] ?? null);
        $this->db->bind(':patient_name', $data['patient_name']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':department_id', $data['department_id']);
        $this->db->bind(':clinic_id', !empty($data['clinic_id']) ? $data['clinic_id'] : null);
        $this->db->bind(':doctor_id', !empty($data['doctor_id']) ? $data['doctor_id'] : null);
        $this->db->bind(':appointment_date', $data['appointment_date']);
        $this->db->bind(':appointment_time', $data['appointment_time'] ?? (($data['time_slot'] === 'morning') ? '09:00:00' : '13:30:00'));
        $this->db->bind(':time_slot', $data['time_slot'] ?? 'morning');
        $this->db->bind(':symptoms', $data['symptoms'] ?? '');
        $this->db->bind(':status', 'pending');
        
        if ($this->db->execute()) {
            return [
                'id' => $this->db->lastInsertId(),
                'booking_ref' => $bookingRef,
                'queue_code' => $queueCode
            ];
        }
        return false;
    }

    public function updateStatus($id, $status) {
        $this->db->query('UPDATE appointments SET status = :status WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('UPDATE appointments SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
