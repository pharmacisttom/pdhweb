<?php
namespace App\Models;

use App\Core\Model;

class Donation extends Model {
    
    public function getAll() {
        $this->db->query('
            SELECT d.*, di.title as item_title, u.firstname as approver_firstname, u.lastname as approver_lastname 
            FROM donations d 
            JOIN donation_items di ON d.donation_item_id = di.id 
            LEFT JOIN users u ON d.approved_by = u.id 
            ORDER BY d.created_at DESC
        ');
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query('
            SELECT d.*, di.title as item_title 
            FROM donations d 
            JOIN donation_items di ON d.donation_item_id = di.id 
            WHERE d.id = :id
        ');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function getByItemId($itemId) {
        $this->db->query('SELECT * FROM donations WHERE donation_item_id = :item_id ORDER BY created_at DESC');
        $this->db->bind(':item_id', $itemId);
        return $this->db->resultSet();
    }

    public function getRecentApproved($limit = 8) {
        $this->db->query('
            SELECT d.donor_name, d.amount, d.quantity, d.created_at, di.title as item_title, di.type as item_type
            FROM donations d
            JOIN donation_items di ON d.donation_item_id = di.id
            WHERE d.status = "approved"
            ORDER BY d.created_at DESC
            LIMIT :limit
        ');
        $this->db->bind(':limit', $limit, \PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function create($data) {
        $this->db->query('INSERT INTO donations (donation_item_id, donor_name, donor_email, donor_phone, amount, quantity, payment_slip_image, status) VALUES (:donation_item_id, :donor_name, :donor_email, :donor_phone, :amount, :quantity, :payment_slip_image, :status)');
        
        $this->db->bind(':donation_item_id', $data['donation_item_id']);
        $this->db->bind(':donor_name', $data['donor_name']);
        $this->db->bind(':donor_email', $data['donor_email'] ?? null);
        $this->db->bind(':donor_phone', $data['donor_phone'] ?? null);
        $this->db->bind(':amount', empty($data['amount']) ? null : $data['amount']);
        $this->db->bind(':quantity', empty($data['quantity']) ? null : $data['quantity']);
        $this->db->bind(':payment_slip_image', $data['payment_slip_image'] ?? null);
        $this->db->bind(':status', 'pending');
        
        return $this->db->execute();
    }

    public function updateStatus($id, $status, $adminNote = null) {
        $this->db->query('UPDATE donations SET status = :status, admin_note = :admin_note, approved_by = :approved_by WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        $this->db->bind(':admin_note', $adminNote);
        $this->db->bind(':approved_by', $_SESSION['user_id'] ?? null);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM donations WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
