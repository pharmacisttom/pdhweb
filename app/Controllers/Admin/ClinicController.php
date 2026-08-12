<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class ClinicController extends Controller {
    
    private $clinicModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->clinicModel = $this->model('Clinic');
    }

    public function index() {
        $clinics = $this->clinicModel->getAll();
        $data = [
            'page_title' => 'จัดการคลินิก',
            'clinics' => $clinics
        ];
        
        $this->view('admin/clinics/index', $data, 'admin');
    }

    public function create() {
        $departmentModel = $this->model('Department');
        $departments = $departmentModel->getAll();
        
        $data = [
            'page_title' => 'เพิ่มคลินิก',
            'departments' => $departments
        ];
        $this->view('admin/clinics/create', $data, 'admin');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            $data = [
                'department_id' => !empty($_POST['department_id']) ? $_POST['department_id'] : null,
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'location' => trim($_POST['location']),
                'phone' => trim($_POST['phone']),
                'note' => trim($_POST['note']),
                'status' => trim($_POST['status'])
            ];

            if ($this->clinicModel->create($data)) {
                $this->redirect('admin/clinics');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function edit($id) {
        $clinic = $this->clinicModel->getById($id);
        $departmentModel = $this->model('Department');
        $departments = $departmentModel->getAll();

        $data = [
            'page_title' => 'แก้ไขคลินิก',
            'clinic' => $clinic,
            'departments' => $departments
        ];
        $this->view('admin/clinics/edit', $data, 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            $data = [
                'id' => $id,
                'department_id' => !empty($_POST['department_id']) ? $_POST['department_id'] : null,
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'location' => trim($_POST['location']),
                'phone' => trim($_POST['phone']),
                'note' => trim($_POST['note']),
                'status' => trim($_POST['status'])
            ];

            if ($this->clinicModel->update($data)) {
                $this->redirect('admin/clinics');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->clinicModel->delete($id)) {
                $this->redirect('admin/clinics');
            } else {
                die('Something went wrong');
            }
        }
    }
}
