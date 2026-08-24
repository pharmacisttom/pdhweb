<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Helpers\Security;

class ServiceController extends Controller {
    
    private $serviceModel;
    private $departmentModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->serviceModel = $this->model('Service');
        $this->departmentModel = $this->model('Department');
    }

    public function index() {
        $services = $this->serviceModel->getAll();
        $data = [
            'page_title' => 'จัดการบริการผู้ป่วย',
            'services' => $services
        ];
        
        $this->view('admin/services/index', $data, 'admin');
    }

    public function create() {
        $departments = $this->departmentModel->getAll();
        $data = [
            'page_title' => 'เพิ่มบริการผู้ป่วย',
            'departments' => $departments
        ];
        $this->view('admin/services/create', $data, 'admin');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Security::validateCsrf();
            $_POST = Security::xssClean($_POST);

            $cover_image = 'default-service.jpg';
            if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../public/assets/images/services/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $origName = basename($_FILES['cover_image']['name']);
                $fileType = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                $fileName = time() . '_' . substr(md5(uniqid()), 0, 8) . '.' . $fileType;
                $targetFilePath = $uploadDir . $fileName;
                
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp');
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetFilePath)) {
                        $cover_image = $fileName;
                    }
                }
            }

            $data = [
                'department_id' => !empty($_POST['department_id']) ? $_POST['department_id'] : null,
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'cover_image' => $cover_image,
                'open_time' => trim($_POST['open_time']),
                'location' => trim($_POST['location']),
                'phone' => trim($_POST['phone']),
                'preparation' => trim($_POST['preparation']),
                'status' => trim($_POST['status'] ?? 'active')
            ];

            if ($this->serviceModel->create($data)) {
                $this->redirect('admin/service');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function edit($id) {
        $service = $this->serviceModel->getById($id);
        $departments = $this->departmentModel->getAll();

        if (!$service) {
            $this->redirect('admin/service');
        }

        $data = [
            'page_title' => 'แก้ไขบริการผู้ป่วย',
            'service' => $service,
            'departments' => $departments
        ];
        $this->view('admin/services/edit', $data, 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Security::validateCsrf();
            $_POST = Security::xssClean($_POST);

            $service = $this->serviceModel->getById($id);
            $cover_image = $service->cover_image;

            if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../public/assets/images/services/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $origName = basename($_FILES['cover_image']['name']);
                $fileType = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                $fileName = time() . '_' . substr(md5(uniqid()), 0, 8) . '.' . $fileType;
                $targetFilePath = $uploadDir . $fileName;
                
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp');
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetFilePath)) {
                        $cover_image = $fileName;
                    }
                }
            }

            $data = [
                'id' => $id,
                'department_id' => !empty($_POST['department_id']) ? $_POST['department_id'] : null,
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'cover_image' => $cover_image,
                'open_time' => trim($_POST['open_time']),
                'location' => trim($_POST['location']),
                'phone' => trim($_POST['phone']),
                'preparation' => trim($_POST['preparation']),
                'status' => trim($_POST['status'] ?? 'active')
            ];

            if ($this->serviceModel->update($data)) {
                $this->redirect('admin/service');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Security::validateCsrf();
            if ($this->serviceModel->delete($id)) {
                $this->redirect('admin/service');
            } else {
                die('Something went wrong');
            }
        }
    }
}
