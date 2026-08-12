<?php
namespace App\Middleware;
use App\Core\Database;

class AuthMiddleware {
    public static function check() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/auth/login');
            exit;
        }
    }

    // Check if user has specific permission
    public static function checkPermission($permissionName) {
        self::check(); // Ensure logged in first
        
        $userId = $_SESSION['user_id'];
        
        $db = new Database();
        // Check if user has this permission through their role
        $db->query("SELECT p.id FROM permissions p 
                    JOIN role_permissions rp ON p.id = rp.permission_id 
                    JOIN users u ON u.role_id = rp.role_id 
                    WHERE u.id = :user_id AND p.name = :permission");
        
        $db->bind(':user_id', $userId);
        $db->bind(':permission', $permissionName);
        
        $row = $db->single();
        
        if (!$row) {
            // User does not have permission
            header('HTTP/1.0 403 Forbidden');
            echo "403 Forbidden - You don't have permission to access this resource.";
            exit();
        }
    }

    // Check if user has a specific role
    public static function checkRole($roleId) {
        self::check();
        
        if ($_SESSION['user_role'] != $roleId && $_SESSION['user_role'] != 1) { // 1 = Super Admin
            header('HTTP/1.0 403 Forbidden');
            echo "403 Forbidden - Access denied.";
            exit();
        }
    }
}
