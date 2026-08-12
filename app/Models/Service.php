<?php
namespace App\Models;

use App\Core\Model;

class Service extends Model {
    
    public function getAll() {
        $this->db->query('SELECT s.*, d.name as department_name FROM services s LEFT JOIN departments d ON s.department_id = d.id WHERE s.deleted_at IS NULL ORDER BY s.name ASC');
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query('SELECT s.*, d.name as department_name FROM services s LEFT JOIN departments d ON s.department_id = d.id WHERE s.id = :id AND s.deleted_at IS NULL');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
