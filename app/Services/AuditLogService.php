<?php
namespace App\Services;

use App\Core\Database;

class AuditLogService {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function logLogin($userId, $username, $status) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? null;
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;

        $this->db->query("INSERT INTO login_logs (user_id, username, ip_address, user_agent, status) VALUES (:user_id, :username, :ip, :ua, :status)");
        
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':username', $username);
        $this->db->bind(':ip', $ip);
        $this->db->bind(':ua', $userAgent);
        $this->db->bind(':status', $status);
        
        return $this->db->execute();
    }

    public function logAudit($userId, $action, $module, $recordId = null, $oldData = null, $newData = null) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? null;
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;

        $this->db->query("INSERT INTO audit_logs (user_id, action, module, record_id, old_data, new_data, ip_address, user_agent) VALUES (:user_id, :action, :module, :record_id, :old_data, :new_data, :ip, :ua)");
        
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':action', $action);
        $this->db->bind(':module', $module);
        $this->db->bind(':record_id', $recordId);
        $this->db->bind(':old_data', $oldData ? json_encode($oldData) : null);
        $this->db->bind(':new_data', $newData ? json_encode($newData) : null);
        $this->db->bind(':ip', $ip);
        $this->db->bind(':ua', $userAgent);

        return $this->db->execute();
    }
}
