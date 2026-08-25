<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\AuditLogService;
use App\Helpers\Security;

class AuthController extends Controller {
    
    private $userModel;
    private $auditLog;

    public function __construct() {
        $this->userModel = $this->model('User');
        $this->auditLog = new AuditLogService();
    }

    public function index() {
        $this->login();
    }

    public function loginForm() {
        $this->login();
    }

    public function login() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('admin/dashboard');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Security::validateCsrf();
            $_POST = Security::xssClean($_POST);
            
            $data = [
                'username' => trim($_POST['username'] ?? ''),
                'password' => trim($_POST['password'] ?? ''),
                'username_err' => '',
                'password_err' => ''
            ];

            if (empty($data['username'])) {
                $data['username_err'] = 'โปรดระบุชื่อผู้ใช้งาน';
            }

            if (empty($data['password'])) {
                $data['password_err'] = 'โปรดระบุรหัสผ่าน';
            }

            if (empty($data['username_err']) && empty($data['password_err'])) {
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if ($loggedInUser) {
                    session_regenerate_id(true);
                    if ($this->auditLog) {
                        $this->auditLog->logLogin($loggedInUser->id, $data['username'], 'success');
                        $this->auditLog->logAudit($loggedInUser->id, 'LOGIN', 'auth');
                    }
                    $this->createUserSession($loggedInUser);
                    return;
                } else {
                    if ($this->auditLog) {
                        $this->auditLog->logLogin(null, $data['username'], 'failed');
                    }
                    $data['password_err'] = 'รหัสผ่านไม่ถูกต้อง หรือ ไม่พบชื่อผู้ใช้งาน';
                    $this->view('auth/login', $data, null);
                    return;
                }
            } else {
                $this->view('auth/login', $data, null);
                return;
            }
        } else {
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
            ];

            $this->view('auth/login', $data, null);
        }
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_username'] = $user->username;
        $_SESSION['user_firstname'] = $user->firstname;
        $_SESSION['user_lastname'] = $user->lastname;
        $_SESSION['user_role'] = $user->role_id;
        $this->redirect('admin/dashboard');
    }

    public function logout(){
        if (isset($_SESSION['user_id']) && $this->auditLog) {
            $this->auditLog->logAudit($_SESSION['user_id'], 'LOGOUT', 'auth');
        }
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = [];
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_destroy();
        }
        $this->redirect('admin/login');
    }
}
