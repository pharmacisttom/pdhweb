<?php
namespace App\Models;

use App\Core\Model;

class DonationItem extends Model {
    
    public function getAll() {
        $this->db->query('SELECT di.*, u.firstname, u.lastname FROM donation_items di LEFT JOIN users u ON di.created_by = u.id WHERE di.deleted_at IS NULL ORDER BY di.created_at DESC');
        return $this->db->resultSet();
    }
    
    public function getActive($limit = null) {
        $sql = 'SELECT * FROM donation_items WHERE status = "active" AND deleted_at IS NULL ORDER BY created_at DESC';
        if ($limit) {
            $sql .= ' LIMIT ' . (int)$limit;
        }
        $this->db->query($sql);
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query('SELECT * FROM donation_items WHERE id = :id AND deleted_at IS NULL');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO donation_items (title, description, type, target_amount, target_quantity, image, status, created_by) VALUES (:title, :description, :type, :target_amount, :target_quantity, :image, :status, :created_by)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':target_amount', empty($data['target_amount']) ? null : $data['target_amount']);
        $this->db->bind(':target_quantity', empty($data['target_quantity']) ? null : $data['target_quantity']);
        $this->db->bind(':image', $data['image'] ?? null);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':created_by', $_SESSION['user_id'] ?? null);
        return $this->db->execute();
    }

    public function update($data) {
        $sql = 'UPDATE donation_items SET title = :title, description = :description, type = :type, target_amount = :target_amount, target_quantity = :target_quantity, status = :status';
        
        if (isset($data['image']) && !empty($data['image'])) {
            $sql .= ', image = :image';
        }
        $sql .= ' WHERE id = :id';

        $this->db->query($sql);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':target_amount', empty($data['target_amount']) ? null : $data['target_amount']);
        $this->db->bind(':target_quantity', empty($data['target_quantity']) ? null : $data['target_quantity']);
        $this->db->bind(':status', $data['status']);
        
        if (isset($data['image']) && !empty($data['image'])) {
            $this->db->bind(':image', $data['image']);
        }
        
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('UPDATE donation_items SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
