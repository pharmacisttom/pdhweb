<?php
namespace App\Models;

use App\Core\Model;

class Page extends Model {
    
    public function getAll() {
        $this->db->query('SELECT p.*, u.firstname, u.lastname FROM pages p LEFT JOIN users u ON p.created_by = u.id WHERE p.deleted_at IS NULL ORDER BY p.title ASC');
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query('SELECT * FROM pages WHERE id = :id AND deleted_at IS NULL');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getBySlug($slug) {
        $this->db->query('SELECT * FROM pages WHERE slug = :slug AND status = "published" AND deleted_at IS NULL');
        $this->db->bind(':slug', $slug);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO pages (title, slug, content, status, created_by) VALUES (:title, :slug, :content, :status, :created_by)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':created_by', $_SESSION['user_id'] ?? null);
        return $this->db->execute();
    }

    public function update($data) {
        $this->db->query('UPDATE pages SET title = :title, slug = :slug, content = :content, status = :status WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':status', $data['status']);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('UPDATE pages SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
