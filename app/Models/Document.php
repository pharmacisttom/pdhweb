<?php
namespace App\Models;

use App\Core\Model;

class Document extends Model
{
    public function getPublished($category)
    {
        $this->db->query('SELECT * FROM documents WHERE category = :category AND status = "published" AND deleted_at IS NULL ORDER BY issued_date DESC, created_at DESC');
        $this->db->bind(':category', $category);
        return $this->db->resultSet();
    }

    public function getAll($category = null)
    {
        $sql = 'SELECT d.*, u.firstname, u.lastname FROM documents d LEFT JOIN users u ON d.created_by = u.id WHERE d.deleted_at IS NULL';
        if ($category !== null) {
            $sql .= ' AND d.category = :category';
        }
        $sql .= ' ORDER BY d.issued_date DESC, d.created_at DESC';
        $this->db->query($sql);
        if ($category !== null) {
            $this->db->bind(':category', $category);
        }
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM documents WHERE id = :id AND deleted_at IS NULL');
        $this->db->bind(':id', (int)$id);
        return $this->db->single();
    }

    public function create($data)
    {
        $this->db->query('INSERT INTO documents (title, description, document_number, category, file_name, original_name, file_size, issued_date, status, created_by) VALUES (:title, :description, :document_number, :category, :file_name, :original_name, :file_size, :issued_date, :status, :created_by)');
        $this->bindDocument($data);
        $this->db->bind(':created_by', $_SESSION['user_id'] ?? null);
        return $this->db->execute();
    }

    public function update($data)
    {
        $this->db->query('UPDATE documents SET title = :title, description = :description, document_number = :document_number, category = :category, file_name = :file_name, original_name = :original_name, file_size = :file_size, issued_date = :issued_date, status = :status WHERE id = :id');
        $this->db->bind(':id', (int)$data['id']);
        $this->bindDocument($data);
        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query('UPDATE documents SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id');
        $this->db->bind(':id', (int)$id);
        return $this->db->execute();
    }

    private function bindDocument($data)
    {
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description'] ?: null);
        $this->db->bind(':document_number', $data['document_number'] ?: null);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':file_name', $data['file_name']);
        $this->db->bind(':original_name', $data['original_name']);
        $this->db->bind(':file_size', (int)$data['file_size']);
        $this->db->bind(':issued_date', $data['issued_date'] ?: null);
        $this->db->bind(':status', $data['status']);
    }
}
