<?php
namespace App\Models;

use App\Core\Model;

class Department extends Model {
    
    public function getAll() {
        $this->db->query('SELECT * FROM departments WHERE deleted_at IS NULL ORDER BY name ASC');
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query('SELECT * FROM departments WHERE id = :id AND deleted_at IS NULL');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO departments (name, description, icon, status) VALUES (:name, :description, :icon, :status)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':status', $data['status']);
        return $this->db->execute();
    }

    public function update($data) {
        $this->db->query('UPDATE departments SET name = :name, description = :description, icon = :icon, status = :status WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':status', $data['status']);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('UPDATE departments SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
