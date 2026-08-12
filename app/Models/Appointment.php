<?php
namespace App\Models;

use App\Core\Model;

class Appointment extends Model {
    
    public function getAll() {
        $this->db->query('
            SELECT a.*, d.name as department_name, c.name as clinic_name, 
                   CONCAT(doc.prefix, doc.firstname, " ", doc.lastname) as doctor_name
            FROM appointments a 
            LEFT JOIN departments d ON a.department_id = d.id 
            LEFT JOIN clinics c ON a.clinic_id = c.id 
            LEFT JOIN doctors doc ON a.doctor_id = doc.id
            WHERE a.deleted_at IS NULL 
            ORDER BY a.appointment_date DESC, a.appointment_time DESC
        ');
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query('SELECT * FROM appointments WHERE id = :id AND deleted_at IS NULL');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('
            INSERT INTO appointments 
            (user_id, hn_number, patient_name, phone, department_id, clinic_id, doctor_id, appointment_date, appointment_time, symptoms, status) 
            VALUES 
            (:user_id, :hn_number, :patient_name, :phone, :department_id, :clinic_id, :doctor_id, :appointment_date, :appointment_time, :symptoms, :status)
        ');
        $this->db->bind(':user_id', $data['user_id'] ?? null);
        $this->db->bind(':hn_number', $data['hn_number']);
        $this->db->bind(':patient_name', $data['patient_name']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':department_id', $data['department_id']);
        $this->db->bind(':clinic_id', !empty($data['clinic_id']) ? $data['clinic_id'] : null);
        $this->db->bind(':doctor_id', !empty($data['doctor_id']) ? $data['doctor_id'] : null);
        $this->db->bind(':appointment_date', $data['appointment_date']);
        $this->db->bind(':appointment_time', !empty($data['appointment_time']) ? $data['appointment_time'] : null);
        $this->db->bind(':symptoms', $data['symptoms']);
        $this->db->bind(':status', $data['status'] ?? 'pending');
        
        return $this->db->execute();
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
