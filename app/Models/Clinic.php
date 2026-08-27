<?php
namespace App\Models;

use App\Core\Model;

class Clinic extends Model {
    
    public function getAll() {
        $this->db->query('SELECT c.*, d.name as department_name FROM clinics c LEFT JOIN departments d ON c.department_id = d.id WHERE c.deleted_at IS NULL ORDER BY c.name ASC');
        return $this->db->resultSet();
    }

    public function getAppointmentEnabled() {
        $this->db->query('SELECT c.*, d.name as department_name FROM clinics c LEFT JOIN departments d ON c.department_id = d.id WHERE c.deleted_at IS NULL AND c.status = "active" AND c.appointment_enabled = 1 ORDER BY c.name ASC');
        return $this->db->resultSet();
    }

    public function getAppointmentEnabledById($id) {
        $this->db->query('SELECT * FROM clinics WHERE id = :id AND deleted_at IS NULL AND status = "active" AND appointment_enabled = 1');
        $this->db->bind(':id', (int)$id);
        return $this->db->single();
    }
    
    public function getById($id) {
        $this->db->query('SELECT c.*, d.name as department_name FROM clinics c LEFT JOIN departments d ON c.department_id = d.id WHERE c.id = :id AND c.deleted_at IS NULL');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function getSchedules($clinic_id) {
        $this->db->query('
            SELECT s.*, d.prefix, d.firstname, d.lastname, d.specialty 
            FROM clinic_schedules s 
            LEFT JOIN doctors d ON s.doctor_id = d.id 
            WHERE s.clinic_id = :clinic_id 
            ORDER BY s.day_of_week ASC, s.start_time ASC
        ');
        $this->db->bind(':clinic_id', $clinic_id);
        return $this->db->resultSet();
    }

    public function create($data) {
        $this->db->query('INSERT INTO clinics (department_id, name, description, location, phone, note, status, appointment_enabled, appointment_slot_quota) VALUES (:department_id, :name, :description, :location, :phone, :note, :status, :appointment_enabled, :appointment_slot_quota)');
        $this->db->bind(':department_id', $data['department_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':note', $data['note']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':appointment_enabled', (int)$data['appointment_enabled']);
        $this->db->bind(':appointment_slot_quota', (int)$data['appointment_slot_quota']);
        return $this->db->execute();
    }

    public function update($data) {
        $this->db->query('UPDATE clinics SET department_id = :department_id, name = :name, description = :description, location = :location, phone = :phone, note = :note, status = :status, appointment_enabled = :appointment_enabled, appointment_slot_quota = :appointment_slot_quota WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':department_id', $data['department_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':note', $data['note']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':appointment_enabled', (int)$data['appointment_enabled']);
        $this->db->bind(':appointment_slot_quota', (int)$data['appointment_slot_quota']);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('UPDATE clinics SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
