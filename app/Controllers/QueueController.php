<?php
namespace App\Controllers;

use App\Core\Controller;

class QueueController extends Controller {
    
    private $queueModel;
    private $departmentModel;
    private $doctorModel;

    public function __construct() {
        $this->queueModel = $this->model('Queue');
        $this->departmentModel = $this->model('Department');
        $this->doctorModel = $this->model('Doctor');
    }

    public function index() {
        $departments = $this->departmentModel->getAll();
        
        $data = [
            'page_title' => 'ศูนย์บริการระบบคิวอัจฉริยะ (Smart Queue Hub)',
            'departments' => $departments
        ];
        
        $this->view('queue/index', $data);
    }

    // Smart Kiosk: กดรับบัตรคิวออนไลน์
    public function kiosk() {
        $departments = $this->departmentModel->getAll();
        
        $data = [
            'page_title' => 'กดรับบัตรคิวออนไลน์ (Smart Queue Kiosk)',
            'departments' => $departments
        ];
        
        $this->view('queue/kiosk', $data);
    }

    // Store Ticket from Kiosk
    public function getTicket() {
        if ($this->isPost()) {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);

            $department_id = (int)$_POST['department_id'];
            $service_type = $_POST['service_type'] ?? 'general';
            $patient_name = trim($_POST['patient_name'] ?? '');
            $phone = trim($_POST['phone'] ?? '');

            if (empty($patient_name)) {
                $patient_name = 'ผู้รับบริการทั่วไป';
            }

            $ticket = $this->queueModel->createSmartQueue([
                'department_id' => $department_id,
                'service_type' => $service_type,
                'patient_name' => $patient_name,
                'phone' => $phone
            ]);

            if ($ticket) {
                $this->redirect('queue/ticket/' . $ticket['id']);
            } else {
                $this->redirect('queue/kiosk');
            }
        }
    }

    // View Smart Ticket Card
    public function ticket($id) {
        $queue = $this->queueModel->getById($id);
        if (!$queue) {
            $this->redirect('queue');
        }

        $allQueues = $this->queueModel->getTodayQueues($queue->department_id);
        $aheadCount = 0;
        foreach ($allQueues as $q) {
            if ($q->status === 'waiting' && $q->id < $queue->id) {
                $aheadCount++;
            }
        }

        // Fetch LINE OA settings
        $db = new \App\Core\Database();
        $db->query("SELECT setting_key, setting_value FROM settings WHERE setting_key IN ('line_oa_id', 'line_add_friend_url')");
        $settingsRaw = $db->resultSet() ?: [];
        $settings = [];
        foreach ($settingsRaw as $sr) {
            $settings[$sr->setting_key] = $sr->setting_value;
        }

        $lineOaId = $settings['line_oa_id'] ?? '@pluakdaenghos';
        $lineUrl = $settings['line_add_friend_url'] ?? 'https://page.line.me/pluakdaenghos';

        $data = [
            'page_title' => 'บัตรคิวหมายเลข ' . $queue->queue_number,
            'queue' => $queue,
            'aheadCount' => $aheadCount,
            'estimatedMins' => max(5, ($aheadCount + 1) * 8),
            'lineOaId' => $lineOaId,
            'lineUrl' => $lineUrl
        ];

        $this->view('queue/ticket', $data);
    }

    // JSON API for Mobile Ticket Live Polling
    public function liveTicketStatus($id) {
        $queue = $this->queueModel->getById($id);
        if (!$queue) {
            return $this->json(['error' => 'Not found'], 404);
        }

        $allQueues = $this->queueModel->getTodayQueues($queue->department_id);
        $aheadCount = 0;
        foreach ($allQueues as $q) {
            if ($q->status === 'waiting' && $q->id < $queue->id) {
                $aheadCount++;
            }
        }

        return $this->json([
            'id' => $queue->id,
            'queue_number' => $queue->queue_number,
            'patient_name' => $queue->patient_name,
            'status' => $queue->status,
            'counter_number' => $queue->counter_number,
            'department_name' => $queue->department_name,
            'ahead_count' => $aheadCount,
            'estimated_wait_minutes' => max(5, ($aheadCount + 1) * 8),
            'called_at' => $queue->called_at ?? $queue->updated_at
        ]);
    }

    // Examination Room Calling Station (หน้าจอแพทย์/พยาบาลกดเรียกคิวประจำห้องตรวจ)
    public function room($room_number = '1') {
        $departments = $this->departmentModel->getAll();
        $department_id = (int)($_GET['department_id'] ?? 1);
        
        $currentQueue = $this->queueModel->getCallingQueueForRoom($room_number);
        $waitingQueues = $this->queueModel->getNextWaitingQueues($department_id, 20);
        $doctors = $this->doctorModel->getAll();

        $data = [
            'page_title' => 'ระบบเรียกคิวประจำห้องตรวจที่ ' . $room_number,
            'room_number' => $room_number,
            'department_id' => $department_id,
            'departments' => $departments,
            'currentQueue' => $currentQueue,
            'waitingQueues' => $waitingQueues,
            'doctors' => $doctors
        ];

        $this->view('queue/room', $data);
    }

    // Single Room Door Display (จอทีวี/แท็บเล็ตแสดงผลหน้าห้องตรวจพร้อมเสียงเรียก)
    public function door($room_number = '1') {
        $department_id = (int)($_GET['department_id'] ?? 1);
        $department = $this->departmentModel->getById($department_id);
        $currentQueue = $this->queueModel->getCallingQueueForRoom($room_number);
        $nextQueues = $this->queueModel->getNextWaitingQueues($department_id, 3);

        $data = [
            'page_title' => 'จอแสดงคิวหน้าห้องตรวจที่ ' . $room_number . ' - ' . ($department ? $department->name : ''),
            'room_number' => $room_number,
            'department' => $department,
            'department_id' => $department_id,
            'currentQueue' => $currentQueue,
            'nextQueues' => $nextQueues
        ];

        $this->view('queue/door', $data);
    }

    // JSON API for Door Screen Live Polling
    public function liveRoomStatus($room_number = '1') {
        $department_id = (int)($_GET['department_id'] ?? 1);
        $currentQueue = $this->queueModel->getCallingQueueForRoom($room_number);
        $nextQueues = $this->queueModel->getNextWaitingQueues($department_id, 3);

        return $this->json([
            'room_number' => $room_number,
            'current_queue' => $currentQueue ? [
                'id' => $currentQueue->id,
                'queue_number' => $currentQueue->queue_number,
                'patient_name' => $currentQueue->patient_name,
                'called_at' => $currentQueue->called_at ?? $currentQueue->updated_at
            ] : null,
            'next_queues' => array_map(fn($q) => [
                'id' => $q->id,
                'queue_number' => $q->queue_number,
                'patient_name' => $q->patient_name
            ], $nextQueues)
        ]);
    }

    // Action execution (Call, Recall, Complete, Skip)
    public function callAction() {
        if ($this->isPost()) {
            \App\Helpers\Security::validateCsrf();
            $act = $_POST['act'] ?? 'call_next';
            $room_number = $_POST['room_number'] ?? '1';
            $department_id = (int)($_POST['department_id'] ?? 1);
            $queue_id = !empty($_POST['queue_id']) ? (int)$_POST['queue_id'] : null;

            if ($act === 'call_next') {
                $waiting = $this->queueModel->getNextWaitingQueues($department_id, 1);
                if (!empty($waiting)) {
                    $this->queueModel->callQueue($waiting[0]->id, $room_number);
                }
            } elseif ($act === 'call_specific' && $queue_id) {
                $this->queueModel->callQueue($queue_id, $room_number);
            } elseif ($act === 'complete' && $queue_id) {
                $this->queueModel->completeQueue($queue_id);
            } elseif ($act === 'skip' && $queue_id) {
                $this->queueModel->skipQueue($queue_id);
            }

            $this->redirect('queue/room/' . $room_number . '?department_id=' . $department_id);
        }
    }

    // Smart Display Screen for Hospital TVs with Thai Voice Announcer
    public function display($department_id = null) {
        $departments = $this->departmentModel->getAll();
        
        if (!$department_id && !empty($departments)) {
            $department_id = $departments[0]->id;
        }

        $department = $this->departmentModel->getById($department_id);
        if (!$department && !empty($departments)) {
            $department = $departments[0];
            $department_id = $department->id;
        }

        $currentQueue = $this->queueModel->getCurrentCallingQueue($department_id);
        $callingCounters = $this->queueModel->getCallingQueuesByCounters($department_id);
        $allQueues = $this->queueModel->getTodayQueues($department_id);
        
        $waitingCount = 0;
        foreach ($allQueues as $q) {
            if ($q->status == 'waiting') $waitingCount++;
        }

        $data = [
            'page_title' => 'จอดิจิทัลเรียกคิว (Smart TV Display) - ' . ($department ? $department->name : ''),
            'department' => $department,
            'departments' => $departments,
            'currentQueue' => $currentQueue,
            'callingCounters' => $callingCounters,
            'allQueues' => $allQueues,
            'waitingCount' => $waitingCount
        ];
        
        $this->view('queue/display', $data);
    }
}
