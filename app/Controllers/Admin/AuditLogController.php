<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\AuditLog;
use App\Middleware\AuthMiddleware;
use App\Helpers\Security;

class AuditLogController extends Controller
{
    protected $auditModel;

    public function __construct()
    {
        AuthMiddleware::check();
        
        // Only Super Admin (1) or Website Admin (2)
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] > 2) {
            $_SESSION['error'] = 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้';
            $this->redirect('admin/dashboard');
            return;
        }
        
        $this->auditModel = new AuditLog();
    }

    public function index()
    {
        $logs = $this->auditModel->getLogsWithUsers(200); // Fetch last 200 logs
        
        $this->view('admin/audit_logs/index', [
            'page_title' => 'ประวัติการทำงาน (Audit Logs)',
            'logs' => $logs
        ], 'admin');
    }

    public function clear()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/logs');
            return;
        }
        
        Security::validateCsrf();
        
        $daysToKeep = 90;
        $this->auditModel->clearOldLogs($daysToKeep);
        
        $userId = $_SESSION['user_id'] ?? null;
        if ($userId) {
            $this->auditModel->log(
                $userId,
                'CLEAR_LOGS',
                'AuditLog',
                null,
                null,
                ['kept_days' => $daysToKeep]
            );
        }
        
        $_SESSION['success'] = "ล้างข้อมูล Log ที่เก่ากว่า {$daysToKeep} วัน เรียบร้อยแล้ว";
        $this->redirect('admin/logs');
    }
}
