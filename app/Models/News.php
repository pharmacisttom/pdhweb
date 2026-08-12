<?php
namespace App\Models;

use App\Core\Model;

class News extends Model {
    
    public function getAll() {
        $this->db->query('SELECT n.*, u.firstname, u.lastname FROM news n LEFT JOIN users u ON n.created_by = u.id WHERE n.deleted_at IS NULL ORDER BY n.created_at DESC');
        return $this->db->resultSet();
    }
    
    public function getPublished($limit = null) {
        $sql = 'SELECT * FROM news WHERE status = "published" AND deleted_at IS NULL ORDER BY published_at DESC';
        if ($limit) {
            $sql .= ' LIMIT ' . (int)$limit;
        }
        $this->db->query($sql);
        return $this->db->resultSet();
    }
    
    public function getPublishedByCategory($category, $limit = 5) {
        $sql = 'SELECT * FROM news WHERE status = "published" AND category = :category AND deleted_at IS NULL ORDER BY published_at DESC LIMIT ' . (int)$limit;
        $this->db->query($sql);
        $this->db->bind(':category', $category);
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query('SELECT * FROM news WHERE id = :id AND deleted_at IS NULL');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getBySlug($slug) {
        $this->db->query('SELECT n.*, u.firstname, u.lastname FROM news n LEFT JOIN users u ON n.created_by = u.id WHERE n.slug = :slug AND n.status = "published" AND n.deleted_at IS NULL');
        $this->db->bind(':slug', $slug);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO news (title, slug, summary, content, cover_image, pdf_file, category, status, published_at, created_by) VALUES (:title, :slug, :summary, :content, :cover_image, :pdf_file, :category, :status, :published_at, :created_by)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':summary', $data['summary']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':cover_image', $data['cover_image']);
        $this->db->bind(':pdf_file', $data['pdf_file'] ?? null);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':published_at', $data['status'] == 'published' ? date('Y-m-d H:i:s') : null);
        $this->db->bind(':created_by', $_SESSION['user_id'] ?? null);
        return $this->db->execute();
    }

    public function update($data) {
        $sql = 'UPDATE news SET title = :title, slug = :slug, summary = :summary, content = :content, category = :category, status = :status';
        
        // If changing status to published, update published_at if not set
        if ($data['status'] == 'published') {
            $sql .= ', published_at = IFNULL(published_at, CURRENT_TIMESTAMP)';
        }
        
        if (isset($data['cover_image']) && !empty($data['cover_image'])) {
            $sql .= ', cover_image = :cover_image';
        }
        if (array_key_exists('pdf_file', $data)) {
            $sql .= ', pdf_file = :pdf_file';
        }
        $sql .= ' WHERE id = :id';

        $this->db->query($sql);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':summary', $data['summary']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':status', $data['status']);
        
        if (isset($data['cover_image']) && !empty($data['cover_image'])) {
            $this->db->bind(':cover_image', $data['cover_image']);
        }
        if (array_key_exists('pdf_file', $data)) {
            $this->db->bind(':pdf_file', $data['pdf_file']);
        }
        
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('UPDATE news SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
