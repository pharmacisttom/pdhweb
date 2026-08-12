<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class DepartmentController extends Controller {
    
    private $departmentModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->departmentModel = $this->model('Department');
    }

    public function index() {
        $departments = $this->departmentModel->getAll();
        $data = [
            'page_title' => 'จัดการกลุ่มงาน',
            'departments' => $departments
        ];
        
        $this->view('admin/departments/index', $data, 'admin');
    }

    public function create() {
        $data = [
            'page_title' => 'เพิ่มกลุ่มงาน'
        ];
        $this->view('admin/departments/create', $data, 'admin');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            $data = [
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'icon' => trim($_POST['icon']),
                'status' => trim($_POST['status'])
            ];

            if ($this->departmentModel->create($data)) {
                $this->redirect('admin/departments');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function edit($id) {
        $department = $this->departmentModel->getById($id);
        $data = [
            'page_title' => 'แก้ไขกลุ่มงาน',
            'department' => $department
        ];
        $this->view('admin/departments/edit', $data, 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'icon' => trim($_POST['icon']),
                'status' => trim($_POST['status'])
            ];

            if ($this->departmentModel->update($data)) {
                $this->redirect('admin/departments');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->departmentModel->delete($id)) {
                $this->redirect('admin/departments');
            } else {
                die('Something went wrong');
            }
        }
    }
}
