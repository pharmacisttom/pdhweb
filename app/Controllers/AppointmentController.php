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
        $departments = $this->departmentModel->getAll();
        $clinics = $this->clinicModel->getAll();
        $doctors = $this->doctorModel->getAll();

        $data = [
            'page_title' => 'นัดหมายแพทย์ล่วงหน้า',
            'departments' => $departments,
            'clinics' => $clinics,
            'doctors' => $doctors
        ];
        
        $this->view('appointment/index', $data);
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            $data = [
                'user_id' => $_SESSION['user_id'] ?? null,
                'hn_number' => trim($_POST['hn_number']),
                'patient_name' => trim($_POST['patient_name']),
                'phone' => trim($_POST['phone']),
                'department_id' => $_POST['department_id'],
                'clinic_id' => !empty($_POST['clinic_id']) ? $_POST['clinic_id'] : null,
                'doctor_id' => !empty($_POST['doctor_id']) ? $_POST['doctor_id'] : null,
                'appointment_date' => trim($_POST['appointment_date']),
                'appointment_time' => !empty($_POST['appointment_time']) ? trim($_POST['appointment_time']) : null,
                'symptoms' => trim($_POST['symptoms']),
                'status' => 'pending'
            ];

            // Validation can be added here
            if(empty($data['patient_name']) || empty($data['phone']) || empty($data['department_id']) || empty($data['appointment_date'])) {
                die('Please fill all required fields');
            }

            if ($this->appointmentModel->create($data)) {
                $this->redirect('appointment/success');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function success() {
        $data = [
            'page_title' => 'บันทึกการนัดหมายสำเร็จ'
        ];
        $this->view('appointment/success', $data);
    }
}
