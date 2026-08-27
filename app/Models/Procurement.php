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

    public function getPublished($filters = []) {
        $sql = 'SELECT p.* FROM procurements p WHERE p.deleted_at IS NULL AND p.status = "active"';
        if (!empty($filters['category'])) $sql .= ' AND p.category = :category';
        if (!empty($filters['budget_year'])) $sql .= ' AND p.budget_year = :budget_year';
        if (!empty($filters['search'])) $sql .= ' AND (p.title LIKE :search OR p.category LIKE :search OR p.method LIKE :search)';
        $sql .= ' ORDER BY p.published_at DESC, p.created_at DESC';
        $this->db->query($sql);
        if (!empty($filters['category'])) $this->db->bind(':category', $filters['category']);
        if (!empty($filters['budget_year'])) $this->db->bind(':budget_year', (int)$filters['budget_year']);
        if (!empty($filters['search'])) $this->db->bind(':search', '%' . $filters['search'] . '%');
        return $this->db->resultSet();
    }

    public function getPublishedById($id) {
        $this->db->query('SELECT * FROM procurements WHERE id = :id AND status = "active" AND deleted_at IS NULL');
        $this->db->bind(':id', (int)$id);
        return $this->db->single();
    }

    public function getCategories() {
        $this->db->query('SELECT category, COUNT(*) AS total FROM procurements WHERE status = "active" AND deleted_at IS NULL GROUP BY category ORDER BY category ASC');
        return $this->db->resultSet();
    }

    public function getBudgetYears() {
        $this->db->query('SELECT DISTINCT budget_year FROM procurements WHERE status = "active" AND deleted_at IS NULL AND budget_year IS NOT NULL ORDER BY budget_year DESC');
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query('SELECT * FROM procurements WHERE id = :id AND deleted_at IS NULL');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO procurements (title, budget_year, project_budget, method, document_url, category, status, published_at, created_by) VALUES (:title, :budget_year, :project_budget, :method, :document_url, :category, :status, :published_at, :created_by)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':budget_year', $data['budget_year']);
        $this->db->bind(':project_budget', !empty($data['project_budget']) ? $data['project_budget'] : null);
        $this->db->bind(':method', $data['method'] ?: null);
        $this->db->bind(':document_url', $data['document_url']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':published_at', $data['published_at']);
        $this->db->bind(':created_by', $_SESSION['user_id'] ?? null);
        
        return $this->db->execute();
    }

    public function update($data) {
        $sql = 'UPDATE procurements SET title = :title, budget_year = :budget_year, project_budget = :project_budget, method = :method, category = :category, status = :status, published_at = :published_at';
        if(isset($data['document_url']) && !empty($data['document_url'])) {
            $sql .= ', document_url = :document_url';
        }
        $sql .= ' WHERE id = :id';

        $this->db->query($sql);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':budget_year', $data['budget_year']);
        $this->db->bind(':project_budget', !empty($data['project_budget']) ? $data['project_budget'] : null);
        $this->db->bind(':method', $data['method'] ?: null);
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
