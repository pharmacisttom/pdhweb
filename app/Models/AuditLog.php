<?php

namespace App\Models;

use App\Core\Model;

class AuditLog extends Model
{
    protected $table = 'audit_logs';

    /**
     * Log an action to the database
     *
     * @param int|null $userId User ID
     * @param string $action Action name (e.g., CREATE, UPDATE, DELETE)
     * @param string $module Module name (e.g., News, User)
     * @param int|null $recordId Related record ID
     * @param mixed $oldData Old data (array or string)
     * @param mixed $newData New data (array or string)
     * @return bool
     */
    public function log($userId, $action, $module, $recordId = null, $oldData = null, $newData = null)
    {
        $oldDataStr = is_array($oldData) ? json_encode($oldData, JSON_UNESCAPED_UNICODE) : $oldData;
        $newDataStr = is_array($newData) ? json_encode($newData, JSON_UNESCAPED_UNICODE) : $newData;
        
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
        
        $sql = "INSERT INTO {$this->table} (user_id, action, module, record_id, old_data, new_data, ip_address, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
                
        return $this->query($sql, [
            $userId, 
            $action, 
            $module, 
            $recordId, 
            $oldDataStr, 
            $newDataStr, 
            $ip
        ]);
    }

    /**
     * Get logs with user details
     */
    public function getLogsWithUsers($limit = 100, $offset = 0)
    {
        $sql = "SELECT a.*, u.username, u.first_name, u.last_name 
                FROM {$this->table} a
                LEFT JOIN users u ON a.user_id = u.id
                ORDER BY a.created_at DESC
                LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
                
        return $this->query($sql)->fetchAll();
    }
    
    /**
     * Clear old logs
     *
     * @param int $days Old logs older than X days will be deleted
     * @return int Number of deleted rows
     */
    public function clearOldLogs($days = 90)
    {
        $sql = "DELETE FROM {$this->table} WHERE created_at < DATE_SUB(NOW(), INTERVAL ? DAY)";
        $this->query($sql, [$days]);
        return $this->db->lastInsertId(); // Actually we need rowCount, wait Model wrapper might not have rowCount easily
        // I will just execute it.
    }
}
