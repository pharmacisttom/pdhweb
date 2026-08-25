<?php
namespace App\Models;

use App\Core\Model;

class Complaint extends Model {
    
    public function getAll() {
        $this->db->query('SELECT * FROM complaints ORDER BY created_at DESC');
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query('SELECT * FROM complaints WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getByTrackingCode($tracking_code) {
        $this->db->query('SELECT * FROM complaints WHERE tracking_code = :tracking_code');
        $this->db->bind(':tracking_code', $tracking_code);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO complaints (tracking_code, fullname, contact_info, topic, message, is_anonymous) VALUES (:tracking_code, :fullname, :contact_info, :topic, :message, :is_anonymous)');
        $this->db->bind(':tracking_code', $data['tracking_code']);
        $this->db->bind(':fullname', $data['fullname']);
        $this->db->bind(':contact_info', $data['contact_info']);
        $this->db->bind(':topic', $data['topic']);
        $this->db->bind(':message', $data['message']);
        $this->db->bind(':is_anonymous', $data['is_anonymous']);
        
        return $this->db->execute();
    }

    public function updateStatus($id, $status, $admin_response = null) {
        $sql = 'UPDATE complaints SET status = :status';
        if ($admin_response !== null) {
            $sql .= ', admin_response = :admin_response';
        }
        $sql .= ' WHERE id = :id';
        
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        if ($admin_response !== null) {
            $this->db->bind(':admin_response', $admin_response);
        }
        
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM complaints WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
