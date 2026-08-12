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
        
        $sql .= ' ORDER BY q.created_at ASC';
        
        $this->db->query($sql);
        
        if ($department_id) {
            $this->db->bind(':department_id', $department_id);
        }
        
        return $this->db->resultSet();
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

    public function create($data) {
        $this->db->query('INSERT INTO queues (department_id, queue_number, patient_name, date_issued, status) VALUES (:department_id, :queue_number, :patient_name, CURDATE(), "waiting")');
        $this->db->bind(':department_id', $data['department_id']);
        $this->db->bind(':queue_number', $data['queue_number']);
        $this->db->bind(':patient_name', $data['patient_name']);
        
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function updateStatus($id, $status) {
        $this->db->query('UPDATE queues SET status = :status WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        return $this->db->execute();
    }
}
