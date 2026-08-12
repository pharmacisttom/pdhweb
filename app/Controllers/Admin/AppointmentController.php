<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class AppointmentController extends Controller {
    
    private $appointmentModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->appointmentModel = $this->model('Appointment');
    }

    public function index() {
        $appointments = $this->appointmentModel->getAll();
        
        $data = [
            'page_title' => 'จัดการข้อมูลนัดหมายผู้ป่วย',
            'appointments' => $appointments
        ];
        
        $this->view('admin/appointments/index', $data, 'admin');
    }

    public function updateStatus($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            $status = $_POST['status'];
            
            if ($this->appointmentModel->updateStatus($id, $status)) {
                $this->redirect('admin/appointments');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->appointmentModel->delete($id)) {
                $this->redirect('admin/appointments');
            } else {
                die('Something went wrong');
            }
        }
    }
}
