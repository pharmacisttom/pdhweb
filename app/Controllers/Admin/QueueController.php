<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class QueueController extends Controller {
    
    private $queueModel;
    private $departmentModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->queueModel = $this->model('Queue');
        $this->departmentModel = $this->model('Department');
    }

    public function index() {
        $department_id = $_GET['department_id'] ?? null;
        $departments = $this->departmentModel->getAll();
        
        if(!$department_id && !empty($departments)) {
            $department_id = $departments[0]->id;
        }

        $queues = [];
        if($department_id) {
            $queues = $this->queueModel->getTodayQueues($department_id);
        }
        
        $data = [
            'page_title' => 'จัดการคิว (รายวัน)',
            'departments' => $departments,
            'selected_department' => $department_id,
            'queues' => $queues
        ];
        
        $this->view('admin/queues/index', $data, 'admin');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            $data = [
                'department_id' => $_POST['department_id'],
                'queue_number' => trim($_POST['queue_number']),
                'patient_name' => trim($_POST['patient_name'])
            ];

            if ($this->queueModel->create($data)) {
                $this->redirect('admin/queues?department_id=' . $data['department_id']);
            } else {
                die('Something went wrong');
            }
        }
    }

    public function updateStatus($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            $status = $_POST['status'];
            $department_id = $_POST['department_id'];
            
            if ($this->queueModel->updateStatus($id, $status)) {
                $this->redirect('admin/queues?department_id=' . $department_id);
            } else {
                die('Something went wrong');
            }
        }
    }
}
