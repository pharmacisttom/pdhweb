<?php
namespace App\Middleware;
use App\Core\Database;

class AuthMiddleware {
    public static function check() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/admin/login');
            exit;
        }
    }

    // Check if user has specific permission
    public static function checkPermission($permissionName) {
        self::check(); // Ensure logged in first

        // Super Admin remains available during the first RBAC migration.
        if ((int)($_SESSION['user_role'] ?? 0) === 1) {
            return;
        }
        
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
            http_response_code(403);
            echo "<h1>403 Forbidden</h1><p>You do not have permission to access this resource.</p>";
            exit();
        }
    }

    // Check if user has a specific role
    public static function checkRole($roleId) {
        self::check();
        
        if ($_SESSION['user_role'] != $roleId && $_SESSION['user_role'] != 1) { // 1 = Super Admin
            http_response_code(403);
            echo "<h1>403 Forbidden</h1><p>Access denied.</p>";
            exit();
        }
    }

    /**
     * Apply one consistent permission rule to every admin controller action.
     */
    public static function authorizeController($controllerClass, $action) {
        self::check();

        $controller = substr(strrchr($controllerClass, '\\'), 1);
        $moduleMap = [
            'DashboardController' => 'dashboard',
            'NewsController' => 'news',
            'BannerController' => 'banners',
            'DepartmentController' => 'departments',
            'ServiceController' => 'services',
            'ClinicController' => 'clinics',
            'DoctorController' => 'doctors',
            'DonationController' => 'donations',
            'DonationItemController' => 'donations',
            'CsrController' => 'pages',
            'ProcurementController' => 'procurements',
            'ComplaintController' => 'complaints',
            'AppointmentController' => 'appointments',
            'QueueController' => 'queues',
            'PageController' => 'pages',
            'SettingsController' => 'settings',
            'AuditLogController' => 'audit_logs',
            'UserController' => 'users',
        ];

        $module = $moduleMap[$controller] ?? null;
        if ($module === null) {
            http_response_code(403);
            exit('Forbidden');
        }

        $readActions = ['index', 'create', 'edit', 'show'];
        self::checkPermission($module . '.' . (in_array($action, $readActions, true) ? 'view' : 'manage'));
    }
}
