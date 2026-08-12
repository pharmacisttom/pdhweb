<?php
namespace App\Models;

use App\Core\Model;

class Procurement extends Model {
    
    public function getAll($category = null) {
        $sql = 'SELECT p.*, u.firstname, u.lastname FROM procurements p LEFT JOIN users u ON p.created_by = u.id WHERE p.deleted_at IS NULL';
        
        if ($category) {
            $sql .= ' AND p.category = :category';
        }
        
        $sql .= ' ORDER BY p.published_at DESC, p.created_at DESC';
        
        $this->db->query($sql);
        
        if ($category) {
            $this->db->bind(':category', $category);
        }
        
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query('SELECT * FROM procurements WHERE id = :id AND deleted_at IS NULL');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO procurements (title, project_budget, document_url, category, status, published_at, created_by) VALUES (:title, :project_budget, :document_url, :category, :status, :published_at, :created_by)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':project_budget', !empty($data['project_budget']) ? $data['project_budget'] : null);
        $this->db->bind(':document_url', $data['document_url']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':published_at', $data['published_at']);
        $this->db->bind(':created_by', $_SESSION['user_id'] ?? null);
        
        return $this->db->execute();
    }

    public function update($data) {
        $sql = 'UPDATE procurements SET title = :title, project_budget = :project_budget, category = :category, status = :status, published_at = :published_at';
        if(isset($data['document_url']) && !empty($data['document_url'])) {
            $sql .= ', document_url = :document_url';
        }
        $sql .= ' WHERE id = :id';

        $this->db->query($sql);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':project_budget', !empty($data['project_budget']) ? $data['project_budget'] : null);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':published_at', $data['published_at']);
        
        if(isset($data['document_url']) && !empty($data['document_url'])) {
            $this->db->bind(':document_url', $data['document_url']);
        }
        
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('UPDATE procurements SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
