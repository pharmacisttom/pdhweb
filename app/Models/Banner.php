<?php
namespace App\Models;

use App\Core\Model;

class Banner extends Model {
    
    public function getAll() {
        $this->db->query('SELECT b.*, u.firstname, u.lastname FROM banners b LEFT JOIN users u ON b.created_by = u.id ORDER BY b.sort_order ASC, b.created_at DESC');
        return $this->db->resultSet();
    }
    
    public function getActive() {
        $this->db->query('SELECT * FROM banners WHERE status = "active" ORDER BY sort_order ASC, created_at DESC');
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query('SELECT * FROM banners WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO banners (title, image_file, link, sort_order, status, created_by) VALUES (:title, :image_file, :link, :sort_order, :status, :created_by)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':image_file', $data['image_file']);
        $this->db->bind(':link', $data['link']);
        $this->db->bind(':sort_order', $data['sort_order']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':created_by', $_SESSION['user_id'] ?? null);
        return $this->db->execute();
    }

    public function update($data) {
        $sql = 'UPDATE banners SET title = :title, link = :link, sort_order = :sort_order, status = :status';
        
        if (isset($data['image_file']) && !empty($data['image_file'])) {
            $sql .= ', image_file = :image_file';
        }
        $sql .= ' WHERE id = :id';

        $this->db->query($sql);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':link', $data['link']);
        $this->db->bind(':sort_order', $data['sort_order']);
        $this->db->bind(':status', $data['status']);
        
        if (isset($data['image_file']) && !empty($data['image_file'])) {
            $this->db->bind(':image_file', $data['image_file']);
        }
        
        return $this->db->execute();
    }

    public function toggleStatus($id) {
        $banner = $this->getById($id);
        if ($banner) {
            $newStatus = ($banner->status === 'active') ? 'inactive' : 'active';
            $this->db->query('UPDATE banners SET status = :status WHERE id = :id');
            $this->db->bind(':status', $newStatus);
            $this->db->bind(':id', $id);
            return $this->db->execute();
        }
        return false;
    }

    public function moveOrder($id, $direction = 'up') {
        $banner = $this->getById($id);
        if (!$banner) return false;

        $currentOrder = (int)$banner->sort_order;
        if ($direction === 'up') {
            $this->db->query('SELECT * FROM banners WHERE sort_order < :ord ORDER BY sort_order DESC LIMIT 1');
            $this->db->bind(':ord', $currentOrder);
            $swapBanner = $this->db->single();
        } else {
            $this->db->query('SELECT * FROM banners WHERE sort_order > :ord ORDER BY sort_order ASC LIMIT 1');
            $this->db->bind(':ord', $currentOrder);
            $swapBanner = $this->db->single();
        }

        if ($swapBanner) {
            $newOrder = $swapBanner->sort_order;
            $this->db->query('UPDATE banners SET sort_order = :ord WHERE id = :id');
            $this->db->bind(':ord', $newOrder);
            $this->db->bind(':id', $banner->id);
            $this->db->execute();

            $this->db->query('UPDATE banners SET sort_order = :ord WHERE id = :id');
            $this->db->bind(':ord', $currentOrder);
            $this->db->bind(':id', $swapBanner->id);
            $this->db->execute();
        } else {
            $newOrder = ($direction === 'up') ? max(0, $currentOrder - 1) : $currentOrder + 1;
            $this->db->query('UPDATE banners SET sort_order = :ord WHERE id = :id');
            $this->db->bind(':ord', $newOrder);
            $this->db->bind(':id', $banner->id);
            $this->db->execute();
        }
        return true;
    }

    public function delete($id) {
        $this->db->query('DELETE FROM banners WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
