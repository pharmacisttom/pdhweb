<?php
namespace App\Models;

use App\Core\Model;

class CsrProject extends Model {
    public function getPublished() {
        $this->db->query('SELECT * FROM csr_projects WHERE is_published = 1 AND deleted_at IS NULL ORDER BY sort_order ASC, project_date DESC, id DESC');
        return $this->db->resultSet();
    }

    public function getAll() {
        $this->db->query('SELECT * FROM csr_projects WHERE deleted_at IS NULL ORDER BY sort_order ASC, project_date DESC, id DESC');
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query('SELECT * FROM csr_projects WHERE id = :id AND deleted_at IS NULL');
        $this->db->bind(':id', (int)$id);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO csr_projects (company_name, project_title, summary, contribution, project_date, image, website, is_published, sort_order) VALUES (:company_name, :project_title, :summary, :contribution, :project_date, :image, :website, :is_published, :sort_order)');
        $this->bindProject($data);
        return $this->db->execute();
    }

    public function update($data) {
        $this->db->query('UPDATE csr_projects SET company_name = :company_name, project_title = :project_title, summary = :summary, contribution = :contribution, project_date = :project_date, image = :image, website = :website, is_published = :is_published, sort_order = :sort_order WHERE id = :id');
        $this->db->bind(':id', (int)$data['id']);
        $this->bindProject($data);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('UPDATE csr_projects SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id');
        $this->db->bind(':id', (int)$id);
        return $this->db->execute();
    }

    private function bindProject($data) {
        $this->db->bind(':company_name', $data['company_name']);
        $this->db->bind(':project_title', $data['project_title']);
        $this->db->bind(':summary', $data['summary']);
        $this->db->bind(':contribution', $data['contribution'] ?: null);
        $this->db->bind(':project_date', $data['project_date'] ?: null);
        $this->db->bind(':image', $data['image'] ?: null);
        $this->db->bind(':website', $data['website'] ?: null);
        $this->db->bind(':is_published', (int)$data['is_published']);
        $this->db->bind(':sort_order', (int)$data['sort_order']);
    }
}
