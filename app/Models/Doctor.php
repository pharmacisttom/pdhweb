<?php
namespace App\Models;

use App\Core\Model;

class Doctor extends Model {
    
    public function getAll() {
        $this->db->query('SELECT * FROM doctors WHERE deleted_at IS NULL ORDER BY firstname ASC');
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query('SELECT * FROM doctors WHERE id = :id AND deleted_at IS NULL');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO doctors (prefix, firstname, lastname, profile_image, position, specialty, biography, status) VALUES (:prefix, :firstname, :lastname, :profile_image, :position, :specialty, :biography, :status)');
        $this->db->bind(':prefix', $data['prefix']);
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':profile_image', $data['profile_image']);
        $this->db->bind(':position', $data['position']);
        $this->db->bind(':specialty', $data['specialty']);
        $this->db->bind(':biography', $data['biography']);
        $this->db->bind(':status', $data['status']);
        return $this->db->execute();
    }

    public function update($data) {
        $this->db->query('UPDATE doctors SET prefix = :prefix, firstname = :firstname, lastname = :lastname, profile_image = :profile_image, position = :position, specialty = :specialty, biography = :biography, status = :status WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':prefix', $data['prefix']);
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':profile_image', $data['profile_image']);
        $this->db->bind(':position', $data['position']);
        $this->db->bind(':specialty', $data['specialty']);
        $this->db->bind(':biography', $data['biography']);
        $this->db->bind(':status', $data['status']);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('UPDATE doctors SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
