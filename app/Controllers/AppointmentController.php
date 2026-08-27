<?php
namespace App\Controllers;

use App\Core\Controller;

class AppointmentController extends Controller {
    
    private $appointmentModel;
    private $departmentModel;
    private $clinicModel;
    private $doctorModel;

    public function __construct() {
        $this->appointmentModel = $this->model('Appointment');
        $this->departmentModel = $this->model('Department');
        $this->clinicModel = $this->model('Clinic');
        $this->doctorModel = $this->model('Doctor');
    }

    public function index() {
        $year = (int)($_GET['year'] ?? date('Y'));
        $month = (int)($_GET['month'] ?? date('m'));
        $department_id = !empty($_GET['department_id']) ? (int)$_GET['department_id'] : null;

        $departments = $this->departmentModel->getAll();
        $clinics = $this->clinicModel->getAppointmentEnabled();
        $doctors = $this->doctorModel->getAll();

        // Get monthly capacity and booked slots
        $monthBookings = $this->appointmentModel->getMonthCapacity($year, $month, $department_id);

        $data = [
            'page_title' => 'ระบบจองคิวนัดหมายออนไลน์ (Smart Calendar Booking)',
            'departments' => $departments,
            'clinics' => $clinics,
            'doctors' => $doctors,
            'year' => $year,
            'month' => $month,
            'selected_department' => $department_id,
            'monthBookings' => $monthBookings,
            'dailyQuota' => 50, // Default daily limit (25 morning + 25 afternoon)
            'slotQuota' => 25
        ];
        
        $this->view('appointment/index', $data);
    }

    // AJAX Endpoint to get specific date slots
    public function getSlots() {
        $date = $_GET['date'] ?? date('Y-m-d');
        $clinicId = !empty($_GET['clinic_id']) ? (int)$_GET['clinic_id'] : null;
        $clinic = $clinicId ? $this->clinicModel->getAppointmentEnabledById($clinicId) : null;
        if ($clinicId && !$clinic) return $this->json(['error' => 'Clinic is not available for appointments'], 404);

        $db = new \App\Core\Database();
        $sql = 'SELECT time_slot, COUNT(*) as booked FROM appointments WHERE appointment_date = :d AND status != "cancelled" AND deleted_at IS NULL';
        if ($clinic) $sql .= ' AND clinic_id = :clinic_id';
        $sql .= ' GROUP BY time_slot';

        $db->query($sql);
        $db->bind(':d', $date);
        if ($clinic) $db->bind(':clinic_id', $clinicId);
        $rows = $db->resultSet() ?: [];

        $morningBooked = 0;
        $afternoonBooked = 0;
        foreach ($rows as $r) {
            if ($r->time_slot === 'morning') $morningBooked = (int)$r->booked;
            if ($r->time_slot === 'afternoon') $afternoonBooked = (int)$r->booked;
        }

        $slotMax = $clinic ? (int)$clinic->appointment_slot_quota : 25;
        return $this->json([
            'date' => $date,
            'morning' => [
                'name' => 'ช่วงเช้า (08:30 - 11:30 น.)',
                'quota' => $slotMax,
                'booked' => $morningBooked,
                'available' => max(0, $slotMax - $morningBooked),
                'is_full' => ($morningBooked >= $slotMax)
            ],
            'afternoon' => [
                'name' => 'ช่วงบ่าย (13:00 - 15:30 น.)',
                'quota' => $slotMax,
                'booked' => $afternoonBooked,
                'available' => max(0, $slotMax - $afternoonBooked),
                'is_full' => ($afternoonBooked >= $slotMax)
            ]
        ]);
    }
    
    public function store() {
        if ($this->isPost()) {
            \App\Helpers\Security::validateCsrf();
            $appointmentDate = trim($_POST['appointment_date'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $clinic = $this->clinicModel->getAppointmentEnabledById((int)($_POST['clinic_id'] ?? 0));
            if (!\App\Helpers\Security::isValidDate($appointmentDate)
                || $appointmentDate < date('Y-m-d')
                || !\App\Helpers\Security::isValidThaiPhone($phone)
                || !$clinic
                || empty($clinic->department_id)
                || !in_array($_POST['time_slot'] ?? '', ['morning', 'afternoon'], true)) {
                $this->setFlash('app_error', 'กรุณาตรวจสอบวันที่นัด ช่วงเวลา และหมายเลขโทรศัพท์ให้ถูกต้อง', 'warning');
                $this->redirect('appointment');
                return;
            }
            
            $data = [
                'user_id' => $_SESSION['user_id'] ?? null,
                'hn_number' => trim($_POST['hn_number'] ?? ''),
                'patient_name' => trim($_POST['patient_name'] ?? ''),
                'phone' => $phone,
                'department_id' => (int)$clinic->department_id,
                'clinic_id' => (int)$clinic->id,
                'slot_quota' => (int)$clinic->appointment_slot_quota,
                'doctor_id' => !empty($_POST['doctor_id']) ? (int)$_POST['doctor_id'] : null,
                'appointment_date' => $appointmentDate,
                'time_slot' => $_POST['time_slot'] ?? 'morning',
                'appointment_time' => ($_POST['time_slot'] === 'morning') ? '09:00:00' : '13:30:00',
                'symptoms' => trim($_POST['symptoms'] ?? '')
            ];

            if(empty($data['patient_name']) || empty($data['phone']) || empty($data['department_id']) || empty($data['appointment_date'])) {
                $this->setFlash('app_error', 'กรุณากรอกข้อมูลที่จำเป็นให้ครบถ้วน', 'warning');
                $this->redirect('appointment');
                return;
            }

            $booking = $this->appointmentModel->createSmartAppointment($data);

            if ($booking) {
                $this->redirect('appointment/ticket/' . $booking['booking_ref']);
            } else {
                $this->setFlash('app_error', 'เกิดข้อผิดพลาดในการจอง กรุณาลองใหม่อีกครั้ง', 'danger');
                $this->redirect('appointment');
            }
        }
    }

    // View Digital Appointment Ticket with QR Code & LINE OA Reminder
    public function ticket($ref) {
        $appointment = $this->appointmentModel->getByBookingRef($ref);
        if (!$appointment) {
            $this->redirect('appointment');
        }

        // Get LINE OA settings
        $db = new \App\Core\Database();
        $db->query("SELECT setting_key, setting_value FROM settings WHERE setting_key IN ('line_oa_id', 'line_add_friend_url')");
        $settingsRaw = $db->resultSet() ?: [];
        $settings = [];
        foreach ($settingsRaw as $sr) {
            $settings[$sr->setting_key] = $sr->setting_value;
        }

        $lineOaId = $settings['line_oa_id'] ?? '@pluakdaenghos';
        $lineUrl = $settings['line_add_friend_url'] ?? 'https://page.line.me/pluakdaenghos';

        // Pre-formatted LINE Reminder Text
        $lineMsg = "ใบนัดตรวจโรงพยาบาลปลวกแดง%0A"
                 . "หมายเลขนัด: " . $appointment->booking_ref . "%0A"
                 . "คิวตรวจ: " . $appointment->queue_code . "%0A"
                 . "ผู้รับบริการ: " . $appointment->patient_name . "%0A"
                 . "วันที่นัด: " . date('d/m/Y', strtotime($appointment->appointment_date)) . "%0A"
                 . "ช่วงเวลา: " . (($appointment->time_slot === 'morning') ? '08:30-11:30 น.' : '13:00-15:30 น.') . "%0A"
                 . "แผนก: " . ($appointment->department_name ?? 'ทั่วไป');

        $data = [
            'page_title' => 'ใบนัดหมายคิวออนไลน์ - ' . $appointment->booking_ref,
            'appointment' => $appointment,
            'lineOaId' => $lineOaId,
            'lineUrl' => $lineUrl,
            'lineMsg' => $lineMsg
        ];

        $this->view('appointment/ticket', $data);
    }
}
