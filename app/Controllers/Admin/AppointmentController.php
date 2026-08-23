<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class AppointmentController extends Controller {
    
    private $appointmentModel;
    private $departmentModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->appointmentModel = $this->model('Appointment');
        $this->departmentModel = $this->model('Department');
    }

    public function index() {
        $filterDate = $_GET['date'] ?? '';
        $filterDept = $_GET['department_id'] ?? '';
        $filterStatus = $_GET['status'] ?? '';

        $filters = [];
        if (!empty($filterDate)) $filters['date'] = $filterDate;
        if (!empty($filterDept)) $filters['department_id'] = $filterDept;
        if (!empty($filterStatus)) $filters['status'] = $filterStatus;

        $appointments = $this->appointmentModel->getAll($filters);
        $departments = $this->departmentModel->getAll();

        // Calculate today's stats
        $db = new \App\Core\Database();
        $db->query("SELECT 
            COUNT(*) as total_today,
            SUM(CASE WHEN time_slot = 'morning' THEN 1 ELSE 0 END) as morning_today,
            SUM(CASE WHEN time_slot = 'afternoon' THEN 1 ELSE 0 END) as afternoon_today,
            SUM(CASE WHEN status = 'confirmed' THEN 1 ELSE 0 END) as confirmed_today
            FROM appointments 
            WHERE appointment_date = CURDATE() AND status != 'cancelled' AND deleted_at IS NULL");
        $todayStats = $db->single();

        $data = [
            'page_title' => 'จัดการคิวนัดหมายผู้ป่วย & ปฏิทินโควตา',
            'appointments' => $appointments,
            'departments' => $departments,
            'filterDate' => $filterDate,
            'filterDept' => $filterDept,
            'filterStatus' => $filterStatus,
            'todayStats' => $todayStats,
            'dailyQuota' => 50
        ];
        
        $this->view('admin/appointments/index', $data, 'admin');
    }

    public function updateStatus($id) {
        if ($this->isPost()) {
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
        if ($this->isPost()) {
            \App\Helpers\Security::validateCsrf();
            if ($this->appointmentModel->delete($id)) {
                $this->redirect('admin/appointments');
            } else {
                die('Something went wrong');
            }
        }
    }
}
