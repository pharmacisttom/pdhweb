<?php
namespace App\Models;

use App\Core\Model;

class Service extends Model {
    
    public function getAll() {
        $this->db->query('SELECT s.*, d.name as department_name FROM services s LEFT JOIN departments d ON s.department_id = d.id WHERE s.deleted_at IS NULL ORDER BY s.id DESC');
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query('SELECT s.*, d.name as department_name FROM services s LEFT JOIN departments d ON s.department_id = d.id WHERE s.id = :id AND s.deleted_at IS NULL');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO services (department_id, name, description, cover_image, open_time, location, phone, preparation, status) VALUES (:department_id, :name, :description, :cover_image, :open_time, :location, :phone, :preparation, :status)');
        $this->db->bind(':department_id', $data['department_id'] ?: null);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description'] ?? null);
        $this->db->bind(':cover_image', $data['cover_image'] ?? 'default-service.jpg');
        $this->db->bind(':open_time', $data['open_time'] ?? null);
        $this->db->bind(':location', $data['location'] ?? null);
        $this->db->bind(':phone', $data['phone'] ?? null);
        $this->db->bind(':preparation', $data['preparation'] ?? null);
        $this->db->bind(':status', $data['status'] ?? 'active');
        return $this->db->execute();
    }

    public function update($data) {
        $this->db->query('UPDATE services SET department_id = :department_id, name = :name, description = :description, cover_image = :cover_image, open_time = :open_time, location = :location, phone = :phone, preparation = :preparation, status = :status WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':department_id', $data['department_id'] ?: null);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description'] ?? null);
        $this->db->bind(':cover_image', $data['cover_image']);
        $this->db->bind(':open_time', $data['open_time'] ?? null);
        $this->db->bind(':location', $data['location'] ?? null);
        $this->db->bind(':phone', $data['phone'] ?? null);
        $this->db->bind(':preparation', $data['preparation'] ?? null);
        $this->db->bind(':status', $data['status'] ?? 'active');
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('UPDATE services SET deleted_at = NOW() WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
