<?php
namespace App\Models;

use App\Core\Model;

class User extends Model {
    
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
