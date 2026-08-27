<?php
namespace App\Models;

use App\Core\Model;

class User extends Model {

    public function getAll() {
        $this->db->query('SELECT u.id, u.username, u.email, u.firstname, u.lastname, u.role_id, u.status, u.last_login, r.name AS role_name FROM users u LEFT JOIN roles r ON r.id = u.role_id WHERE u.deleted_at IS NULL ORDER BY u.username');
        return $this->db->resultSet() ?: [];
    }

    public function getById($id) {
        $this->db->query('SELECT id, username, email, firstname, lastname, role_id, status FROM users WHERE id = :id AND deleted_at IS NULL');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getRoles() {
        $this->db->query('SELECT id, name FROM roles ORDER BY id');
        return $this->db->resultSet() ?: [];
    }

    public function usernameExists($username, $excludeId = null) {
        $sql = 'SELECT id FROM users WHERE username = :value AND deleted_at IS NULL';
        if ($excludeId !== null) $sql .= ' AND id != :exclude_id';
        $this->db->query($sql);
        $this->db->bind(':value', $username);
        if ($excludeId !== null) $this->db->bind(':exclude_id', $excludeId);
        return (bool)$this->db->single();
    }

    public function emailExists($email, $excludeId = null) {
        $sql = 'SELECT id FROM users WHERE email = :value AND deleted_at IS NULL';
        if ($excludeId !== null) $sql .= ' AND id != :exclude_id';
        $this->db->query($sql);
        $this->db->bind(':value', $email);
        if ($excludeId !== null) $this->db->bind(':exclude_id', $excludeId);
        return (bool)$this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO users (username, email, password, role_id, firstname, lastname, status) VALUES (:username, :email, :password, :role_id, :firstname, :lastname, "active")');
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':role_id', $data['role_id']);
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lastname', $data['lastname']);
        return $this->db->execute() ? (int)$this->db->lastInsertId() : 0;
    }

    public function update($id, $data) {
        $sql = 'UPDATE users SET username = :username, email = :email, role_id = :role_id, firstname = :firstname, lastname = :lastname';
        if ($data['password'] !== '') $sql .= ', password = :password';
        $sql .= ' WHERE id = :id';
        $this->db->query($sql);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role_id', $data['role_id']);
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lastname', $data['lastname']);
        if ($data['password'] !== '') $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function setStatus($id, $status) {
        if (!in_array($status, ['active', 'inactive'], true)) return false;
        $this->db->query('UPDATE users SET status = :status WHERE id = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    
    // Find user by username
    public function findUserByUsername($username) {
        $this->db->query('SELECT * FROM users WHERE username = :username AND deleted_at IS NULL');
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    // Login user
    public function login($username, $password) {
        $row = $this->findUserByUsername($username);
        
        if ($row) {
            $hashed_password = $row->password;
            if (password_verify($password, $hashed_password)) {
                // Update last login
                $this->db->query('UPDATE users SET last_login = NOW() WHERE id = :id');
                $this->db->bind(':id', $row->id);
                $this->db->execute();
                
                return $row;
            }
        }
        return false;
    }
}
