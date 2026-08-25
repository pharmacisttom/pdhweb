<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\AuditLogService;

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

    public function login() {
        // If already logged in, redirect to admin
        if(isset($_SESSION['user_id'])){
            $this->redirect('admin/dashboard');
        }

        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => ''
            ];

            // Validate Username
            if(empty($data['username'])){
                $data['username_err'] = 'โปรดระบุชื่อผู้ใช้งาน';
            }

            // Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'โปรดระบุรหัสผ่าน';
            }

            // Check if errors are empty
            if(empty($data['username_err']) && empty($data['password_err'])){
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if($loggedInUser){
                    // Log success
                    $this->auditLog->logLogin($loggedInUser->id, $data['username'], 'success');
                    $this->auditLog->logAudit($loggedInUser->id, 'LOGIN', 'auth');
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    // Log failed
                    $this->auditLog->logLogin(null, $data['username'], 'failed');
                    $data['password_err'] = 'รหัสผ่านไม่ถูกต้อง หรือ ไม่พบชื่อผู้ใช้งาน';
                    $this->view('auth/login', $data, null); // Render login page without layout for now or auth layout
                }
            } else {
                // Load view with errors
                $this->view('auth/login', $data, null);
            }
        } else {
            // Init data
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
            ];

            // Load view
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
        if(isset($_SESSION['user_id'])){
            $this->auditLog->logAudit($_SESSION['user_id'], 'LOGOUT', 'auth');
        }
        unset($_SESSION['user_id']);
        unset($_SESSION['user_username']);
        unset($_SESSION['user_firstname']);
        unset($_SESSION['user_lastname']);
        unset($_SESSION['user_role']);
        session_destroy();
        $this->redirect('auth/login');
    }
}
