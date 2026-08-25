<?php

namespace App\Models;

use App\Core\Model;

class AuditLog extends Model
{
    protected $table = 'audit_logs';

    /**
     * Log an action to the database
     */
    public function log($userId, $action, $module, $recordId = null, $oldData = null, $newData = null)
    {
        $oldDataStr = is_array($oldData) ? json_encode($oldData, JSON_UNESCAPED_UNICODE) : $oldData;
        $newDataStr = is_array($newData) ? json_encode($newData, JSON_UNESCAPED_UNICODE) : $newData;
        
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
        
        $this->db->query("INSERT INTO {$this->table} (user_id, action, module, record_id, old_data, new_data, ip_address, created_at) 
                VALUES (:user_id, :action, :module, :record_id, :old_data, :new_data, :ip_address, NOW())");
                
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':action', $action);
        $this->db->bind(':module', $module);
        $this->db->bind(':record_id', $recordId);
        $this->db->bind(':old_data', $oldDataStr);
        $this->db->bind(':new_data', $newDataStr);
        $this->db->bind(':ip_address', $ip);
        
        return $this->db->execute();
    }

    /**
     * Get logs with user details
     */
    public function getLogsWithUsers($limit = 100, $offset = 0)
    {
        $this->db->query("SELECT a.*, u.username, u.firstname as first_name, u.lastname as last_name 
                FROM {$this->table} a
                LEFT JOIN users u ON a.user_id = u.id
                ORDER BY a.created_at DESC
                LIMIT :limit OFFSET :offset");
                
        $this->db->bind(':limit', (int)$limit, \PDO::PARAM_INT);
        $this->db->bind(':offset', (int)$offset, \PDO::PARAM_INT);
        
        return $this->db->resultSet();
    }
    
    /**
     * Clear old logs
     */
    public function clearOldLogs($days = 90)
    {
        $this->db->query("DELETE FROM {$this->table} WHERE created_at < DATE_SUB(NOW(), INTERVAL :days DAY)");
        $this->db->bind(':days', (int)$days, \PDO::PARAM_INT);
        return $this->db->execute();
    }
}
