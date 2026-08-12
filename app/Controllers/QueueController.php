<?php
namespace App\Controllers;

use App\Core\Controller;

class QueueController extends Controller {
    
    private $queueModel;
    private $departmentModel;

    public function __construct() {
        $this->queueModel = $this->model('Queue');
        $this->departmentModel = $this->model('Department');
    }

    public function index() {
        $departments = $this->departmentModel->getAll();
        
        $data = [
            'page_title' => 'ตรวจสอบคิวรับบริการ (Real-time)',
            'departments' => $departments
        ];
        
        $this->view('queue/index', $data);
    }

    public function display($department_id) {
        $department = $this->departmentModel->getById($department_id);
        if(!$department) {
            $this->redirect('queue');
        }

        $currentQueue = $this->queueModel->getCurrentCallingQueue($department_id);
        $allQueues = $this->queueModel->getTodayQueues($department_id);
        
        // Count waiting
        $waitingCount = 0;
        foreach($allQueues as $q) {
            if($q->status == 'waiting') $waitingCount++;
        }

        $data = [
            'page_title' => 'คิวแผนก ' . $department->name,
            'department' => $department,
            'currentQueue' => $currentQueue,
            'allQueues' => $allQueues,
            'waitingCount' => $waitingCount
        ];
        
        $this->view('queue/display', $data);
    }
}
