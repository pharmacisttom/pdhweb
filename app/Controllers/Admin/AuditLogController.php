<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\AuditLog;

class AuditLogController extends Controller
{
    protected $auditModel;

    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/admin/login');
        }
        
        // Only Super Admin or Website Admin should access logs
        if ($_SESSION['user']['role_id'] > 2) {
            $_SESSION['error'] = 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้';
            $this->redirect('/admin');
        }
        
        $this->auditModel = new AuditLog();
    }

    public function index()
    {
        $logs = $this->auditModel->getLogsWithUsers(200); // Fetch last 200 logs
        
        $this->view('admin.audit_logs.index', [
            'title' => 'ประวัติการทำงาน (Audit Logs)',
            'logs' => $logs
        ]);
    }

    public function clear()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return $this->redirect('/admin/logs');
        verify_csrf($_POST['csrf_token'] ?? '');
        
        // Define how many days of logs to keep. Default to 90 days.
        $daysToKeep = 90;
        
        $this->auditModel->clearOldLogs($daysToKeep);
        
        // Log the clearing action itself
        $this->auditModel->log(
            $_SESSION['user']['id'],
            'CLEAR_LOGS',
            'AuditLog',
            null,
            null,
            ['kept_days' => $daysToKeep]
        );
        
        $_SESSION['success'] = "ล้างข้อมูล Log ที่เก่ากว่า {$daysToKeep} วัน เรียบร้อยแล้ว เพื่อให้ระบบทำงานไวขึ้น";
        $this->redirect('/admin/logs');
    }
}
