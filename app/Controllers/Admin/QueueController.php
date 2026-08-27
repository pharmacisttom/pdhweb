<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class QueueController extends Controller {
    
    private $queueModel;
    private $departmentModel;

    public function __construct() {
        AuthMiddleware::check();

        $db = new \App\Core\Database();
        $db->query("SELECT setting_value FROM settings WHERE setting_key = 'queue_enabled'");
        $setting = $db->single();
        if (!$setting || $setting->setting_value !== '1') {
            $this->setFlash('settings_warning', 'ระบบคิวยังไม่เปิดใช้งาน กรุณาเปิดจากการตั้งค่าระบบก่อน', 'warning');
            $this->redirect('admin/settings');
        }

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

        $waitingCount = count(array_filter($queues, fn($q) => $q->status === 'waiting'));
        $callingCount = count(array_filter($queues, fn($q) => $q->status === 'calling'));
        $completedCount = count(array_filter($queues, fn($q) => $q->status === 'completed'));
        
        $data = [
            'page_title' => 'แผงควบคุมระบบคิวอัจฉริยะ (Smart Queue Control)',
            'departments' => $departments,
            'selected_department' => $department_id,
            'queues' => $queues,
            'waitingCount' => $waitingCount,
            'callingCount' => $callingCount,
            'completedCount' => $completedCount
        ];
        
        $this->view('admin/queues/index', $data, 'admin');
    }

    // Call Next Queue
    public function callNext() {
        if ($this->isPost()) {
            \App\Helpers\Security::validateCsrf();
            $department_id = (int)$_POST['department_id'];
            $counter_number = $_POST['counter_number'] ?? '1';

            $queues = $this->queueModel->getTodayQueues($department_id);
            $nextWaiting = null;
            foreach ($queues as $q) {
                if ($q->status === 'waiting') {
                    $nextWaiting = $q;
                    break;
                }
            }

            if ($nextWaiting) {
                $this->queueModel->callQueue($nextWaiting->id, $counter_number);
                $this->setFlash('queue_success', "เรียกคิว {$nextWaiting->queue_number} เข้าช่องบริการ {$counter_number} เรียบร้อยแล้ว");
            } else {
                $this->setFlash('queue_warning', "ไม่มีคิวรอตรวจในขณะนี้", 'warning');
            }

            $this->redirect('admin/queue?department_id=' . $department_id);
        }
    }

    // Action Dispatcher (Call, Recall, Complete, Skip)
    public function action($id) {
        if ($this->isPost()) {
            \App\Helpers\Security::validateCsrf();
            $act = $_POST['act'] ?? 'complete';
            $department_id = (int)($_POST['department_id'] ?? 1);
            $counter_number = $_POST['counter_number'] ?? '1';

            if ($act === 'call') {
                $this->queueModel->callQueue($id, $counter_number);
                $this->setFlash('queue_success', "กำลังเรียกคิวที่ช่องบริการ {$counter_number}");
            } elseif ($act === 'complete') {
                $this->queueModel->completeQueue($id);
                $this->setFlash('queue_success', "บันทึกคิวเสร็จสิ้นการบริการแล้ว");
            } elseif ($act === 'skip') {
                $this->queueModel->skipQueue($id);
                $this->setFlash('queue_info', "ข้ามคิวเรียบร้อยแล้ว", 'info');
            }

            $this->redirect('admin/queue?department_id=' . $department_id);
        }
    }

    // Fast ticket issue by nurse
    public function fastTicket() {
        if ($this->isPost()) {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);

            $department_id = (int)$_POST['department_id'];
            $patient_name = trim($_POST['patient_name'] ?? '');
            $service_type = $_POST['service_type'] ?? 'general';

            if (empty($patient_name)) $patient_name = 'ผู้รับบริการทั่วไป';

            $ticket = $this->queueModel->createSmartQueue([
                'department_id' => $department_id,
                'patient_name' => $patient_name,
                'service_type' => $service_type
            ]);

            if ($ticket) {
                $this->setFlash('queue_success', "ออกบัตรคิวหมายเลข {$ticket['queue_number']} เรียบร้อยแล้ว");
            }

            $this->redirect('admin/queue?department_id=' . $department_id);
        }
    }
}
