<?php
namespace App\Models;

use App\Core\Model;

class Banner extends Model {
    
    public function getAll() {
        $this->db->query('SELECT b.*, u.firstname, u.lastname FROM banners b LEFT JOIN users u ON b.created_by = u.id ORDER BY b.sort_order ASC, b.created_at DESC');
        return $this->db->resultSet();
    }
    
    public function getActive() {
        $this->db->query('SELECT * FROM banners WHERE status = "active" ORDER BY sort_order ASC, created_at DESC');
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query('SELECT * FROM banners WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO banners (title, image_file, link, sort_order, status, created_by) VALUES (:title, :image_file, :link, :sort_order, :status, :created_by)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':image_file', $data['image_file']);
        $this->db->bind(':link', $data['link']);
        $this->db->bind(':sort_order', $data['sort_order']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':created_by', $_SESSION['user_id'] ?? null);
        return $this->db->execute();
    }

    public function update($data) {
        $sql = 'UPDATE banners SET title = :title, link = :link, sort_order = :sort_order, status = :status';
        
        if (isset($data['image_file']) && !empty($data['image_file'])) {
            $sql .= ', image_file = :image_file';
        }
        $sql .= ' WHERE id = :id';

        $this->db->query($sql);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':link', $data['link']);
        $this->db->bind(':sort_order', $data['sort_order']);
        $this->db->bind(':status', $data['status']);
        
        if (isset($data['image_file']) && !empty($data['image_file'])) {
            $this->db->bind(':image_file', $data['image_file']);
        }
        
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM banners WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
