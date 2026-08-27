<?php
namespace App\Models;

use App\Core\Model;

class Queue extends Model {

    public function getTodayQueues($department_id = null) {
        $sql = '
            SELECT q.*, d.name as department_name 
            FROM queues q 
            LEFT JOIN departments d ON q.department_id = d.id 
            WHERE q.date_issued = CURDATE()
        ';
        
        if ($department_id) {
            $sql .= ' AND q.department_id = :department_id';
        }
        
        $sql .= ' ORDER BY 
            CASE 
                WHEN q.status = "calling" THEN 1
                WHEN q.status = "waiting" THEN 2
                WHEN q.status = "completed" THEN 3
                ELSE 4
            END, q.created_at ASC';
        
        $this->db->query($sql);
        
        if ($department_id) {
            $this->db->bind(':department_id', $department_id);
        }
        
        return $this->db->resultSet() ?: [];
    }
    
    public function getCurrentCallingQueue($department_id) {
        $this->db->query('
            SELECT * FROM queues 
            WHERE department_id = :department_id 
            AND status = "calling" 
            AND date_issued = CURDATE() 
            ORDER BY updated_at DESC LIMIT 1
        ');
        $this->db->bind(':department_id', $department_id);
        return $this->db->single();
    }

    public function getCallingQueueForRoom($room_number) {
        $this->db->query('
            SELECT * FROM queues 
            WHERE counter_number = :room 
            AND status = "calling" 
            AND date_issued = CURDATE() 
            ORDER BY updated_at DESC LIMIT 1
        ');
        $this->db->bind(':room', (string)$room_number);
        return $this->db->single();
    }

    public function getNextWaitingQueues($department_id = null, $limit = 5) {
        $sql = 'SELECT * FROM queues WHERE status = "waiting" AND date_issued = CURDATE()';
        if ($department_id) {
            $sql .= ' AND department_id = :dept';
        }
        $sql .= ' ORDER BY id ASC LIMIT ' . (int)$limit;

        $this->db->query($sql);
        if ($department_id) {
            $this->db->bind(':dept', $department_id);
        }
        return $this->db->resultSet() ?: [];
    }

    public function getCallingQueuesByCounters($department_id) {
        $this->db->query('
            SELECT * FROM queues 
            WHERE department_id = :department_id 
            AND status = "calling" 
            AND date_issued = CURDATE() 
            ORDER BY updated_at DESC
        ');
        $this->db->bind(':department_id', $department_id);
        return $this->db->resultSet() ?: [];
    }

    /**
     * Generate Smart Queue Number
     */
    public function generateSmartQueueNumber($department_id, $service_type = 'general') {
        $prefixes = [
            'general' => 'A',
            'pediatric' => 'P',
            'dental' => 'D',
            'lab' => 'L',
            'pharmacy' => 'R',
            'emergency' => 'E'
        ];
        $prefix = $prefixes[$service_type] ?? 'A';

        $this->db->query('
            SELECT COUNT(*) as count FROM queues 
            WHERE department_id = :dept 
            AND date_issued = CURDATE() 
            AND queue_number LIKE :prefix
        ');
        $this->db->bind(':dept', $department_id);
        $this->db->bind(':prefix', $prefix . '%');
        $row = $this->db->single();
        $nextNum = ($row->count ?? 0) + 1;

        return sprintf('%s-%03d', $prefix, $nextNum);
    }

    public function createSmartQueue($data) {
        $queueNumber = $data['queue_number'] ?? $this->generateSmartQueueNumber($data['department_id'], $data['service_type'] ?? 'general');
        
        // Calculate estimated wait time (waiting count * 8 minutes)
        $this->db->query('SELECT COUNT(*) as count FROM queues WHERE department_id = :dept AND status = "waiting" AND date_issued = CURDATE()');
        $this->db->bind(':dept', $data['department_id']);
        $waitingRow = $this->db->single();
        $estimatedMins = max(5, (($waitingRow->count ?? 0) + 1) * 8);

        $this->db->query('INSERT INTO queues (department_id, queue_number, patient_name, phone, service_type, counter_number, estimated_wait_minutes, date_issued, status) 
                          VALUES (:department_id, :queue_number, :patient_name, :phone, :service_type, :counter_number, :estimated_wait_minutes, CURDATE(), "waiting")');
        $this->db->bind(':department_id', $data['department_id']);
        $this->db->bind(':queue_number', $queueNumber);
        $this->db->bind(':patient_name', $data['patient_name']);
        $this->db->bind(':phone', $data['phone'] ?? null);
        $this->db->bind(':service_type', $data['service_type'] ?? 'general');
        $this->db->bind(':counter_number', $data['counter_number'] ?? '1');
        $this->db->bind(':estimated_wait_minutes', $estimatedMins);
        
        if ($this->db->execute()) {
            return [
                'id' => $this->db->lastInsertId(),
                'queue_number' => $queueNumber,
                'waiting_count' => $waitingRow->count ?? 0,
                'estimated_wait_minutes' => $estimatedMins
            ];
        }
        return false;
    }

    public function callQueue($id, $counter_number = '1') {
        $this->db->query('UPDATE queues SET status = "calling", counter_number = :counter, called_at = NOW(), updated_at = NOW() WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':counter', (string)$counter_number);
        return $this->db->execute();
    }

    public function completeQueue($id) {
        $this->db->query('UPDATE queues SET status = "completed", completed_at = NOW(), updated_at = NOW() WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function skipQueue($id) {
        $this->db->query('UPDATE queues SET status = "skipped", updated_at = NOW() WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function updateStatus($id, $status) {
        $this->db->query('UPDATE queues SET status = :status, updated_at = NOW() WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        return $this->db->execute();
    }

    public function getById($id) {
        $this->db->query('SELECT q.*, d.name as department_name FROM queues q LEFT JOIN departments d ON q.department_id = d.id WHERE q.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
