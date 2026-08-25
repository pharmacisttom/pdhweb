<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Helpers\Security;

class AuthController extends Controller
{
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
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
                    $_SESSION['user_id'] = $loggedInUser->id;
                    $_SESSION['user_username'] = $loggedInUser->username;
                    $_SESSION['user_firstname'] = $loggedInUser->firstname;
                    $_SESSION['user_lastname'] = $loggedInUser->lastname;
                    $_SESSION['user_role'] = $loggedInUser->role_id;
                    
                    $this->redirect('admin/dashboard');
                    return;
                } else {
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

    public function logout() {
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
