<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

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
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);

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
        unset($_SESSION['user_id']);
        unset($_SESSION['user_username']);
        unset($_SESSION['user_firstname']);
        unset($_SESSION['user_lastname']);
        unset($_SESSION['user_role']);
        session_destroy();
        $this->redirect('auth/login');
    }
}
