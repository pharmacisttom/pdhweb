<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Database;
use PDO;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (isset($_SESSION['user'])) {
            $this->redirect('/admin');
        }
        
        $data = [
            'title' => 'Admin Login | PDH Web Portal',
        ];
        $this->view('admin.auth.login', $data);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/login');
        }

        verify_csrf($_POST['csrf_token'] ?? '');

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $_SESSION['error'] = 'Username and password are required.';
            $this->redirect('/admin/login');
        }

        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username AND status = 'active' LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Success
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role_id' => $user['role_id'],
                'name' => $user['first_name'] . ' ' . $user['last_name']
            ];

            // Log success
            $stmtLog = $db->prepare("INSERT INTO login_logs (user_id, ip_address, browser, status) VALUES (?, ?, ?, 'success')");
            $stmtLog->execute([$user['id'], $_SERVER['REMOTE_ADDR'] ?? '', $_SERVER['HTTP_USER_AGENT'] ?? '']);

            // Update last login
            $stmtUpd = $db->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $stmtUpd->execute([$user['id']]);

            $this->redirect('/admin');
        } else {
            // Failed
            $_SESSION['error'] = 'Invalid username or password.';
            
            if ($user) {
                $stmtLog = $db->prepare("INSERT INTO login_logs (user_id, ip_address, browser, status) VALUES (?, ?, ?, 'failed')");
                $stmtLog->execute([$user['id'], $_SERVER['REMOTE_ADDR'] ?? '', $_SERVER['HTTP_USER_AGENT'] ?? '']);
            }
            
            $this->redirect('/admin/login');
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        $this->redirect('/admin/login');
    }
}
