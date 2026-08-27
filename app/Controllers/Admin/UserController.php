<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Helpers\Security;
use App\Models\User;
use App\Services\AuditLogService;

class UserController extends Controller
{
    private $users;
    private $audit;

    public function __construct()
    {
        $this->users = new User();
        $this->audit = new AuditLogService();
    }

    public function index()
    {
        $this->view('admin/users/index', [
            'page_title' => 'จัดการผู้ใช้งาน',
            'users' => $this->users->getAll(),
        ], 'admin');
    }

    public function create()
    {
        $this->view('admin/users/form', [
            'page_title' => 'เพิ่มผู้ใช้งาน',
            'roles' => $this->users->getRoles(),
            'user' => null,
        ], 'admin');
    }

    public function store()
    {
        Security::validateCsrf();
        $data = $this->validatedData(true);
        if ($data === null || $this->users->usernameExists($data['username']) || $this->users->emailExists($data['email'])) {
            $this->setFlash('user_error', 'ไม่สามารถสร้างผู้ใช้งานได้ กรุณาตรวจสอบข้อมูลซ้ำและรหัสผ่าน');
            $this->redirect('admin/users/create');
            return;
        }

        $id = $this->users->create($data);
        if ($id) {
            $this->audit->logAudit($_SESSION['user_id'], 'create', 'users', $id, null, ['username' => $data['username'], 'role_id' => $data['role_id']]);
            $this->setFlash('user_success', 'สร้างผู้ใช้งานเรียบร้อยแล้ว');
        }
        $this->redirect('admin/users');
    }

    public function edit($id)
    {
        $user = $this->users->getById((int)$id);
        if (!$user) {
            $this->redirect('admin/users');
            return;
        }

        $this->view('admin/users/form', [
            'page_title' => 'แก้ไขผู้ใช้งาน',
            'roles' => $this->users->getRoles(),
            'user' => $user,
        ], 'admin');
    }

    public function update($id)
    {
        Security::validateCsrf();
        $id = (int)$id;
        $current = $this->users->getById($id);
        $data = $this->validatedData(false);
        if (!$current || $data === null || $this->users->usernameExists($data['username'], $id) || $this->users->emailExists($data['email'], $id)) {
            $this->setFlash('user_error', 'ไม่สามารถบันทึกผู้ใช้งานได้ กรุณาตรวจสอบข้อมูล');
            $this->redirect('admin/users/edit/' . $id);
            return;
        }

        if ($this->users->update($id, $data)) {
            $this->audit->logAudit($_SESSION['user_id'], 'update', 'users', $id, ['username' => $current->username, 'role_id' => $current->role_id], ['username' => $data['username'], 'role_id' => $data['role_id']]);
            $this->setFlash('user_success', 'บันทึกผู้ใช้งานเรียบร้อยแล้ว');
        }
        $this->redirect('admin/users');
    }

    public function updateStatus($id)
    {
        Security::validateCsrf();
        $id = (int)$id;
        if ($id === (int)$_SESSION['user_id']) {
            $this->setFlash('user_error', 'ไม่สามารถปิดการใช้งานบัญชีของตนเองได้');
        } elseif ($this->users->setStatus($id, $_POST['status'] ?? 'inactive')) {
            $this->audit->logAudit($_SESSION['user_id'], 'update_status', 'users', $id, null, ['status' => $_POST['status'] ?? 'inactive']);
            $this->setFlash('user_success', 'อัปเดตสถานะผู้ใช้งานแล้ว');
        }
        $this->redirect('admin/users');
    }

    private function validatedData($requiresPassword)
    {
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = (string)($_POST['password'] ?? '');
        $roleId = (int)($_POST['role_id'] ?? 0);
        $firstname = trim($_POST['firstname'] ?? '');
        $lastname = trim($_POST['lastname'] ?? '');

        if (!preg_match('/^[A-Za-z0-9_.-]{3,50}$/', $username) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $roleId < 1 || $firstname === '' || $lastname === '') {
            return null;
        }
        if (($requiresPassword && strlen($password) < 12) || (!$requiresPassword && $password !== '' && strlen($password) < 12)) {
            return null;
        }

        return [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role_id' => $roleId,
            'firstname' => $firstname,
            'lastname' => $lastname,
        ];
    }
}
