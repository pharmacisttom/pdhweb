<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Helpers\Security;

class DoctorController extends Controller {
    
    private $doctorModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->doctorModel = $this->model('Doctor');
    }

    public function index() {
        $doctors = $this->doctorModel->getAll();
        $data = [
            'page_title' => 'จัดการแพทย์',
            'doctors' => $doctors
        ];
        
        $this->view('admin/doctors/index', $data, 'admin');
    }

    public function create() {
        $data = [
            'page_title' => 'เพิ่มแพทย์'
        ];
        $this->view('admin/doctors/create', $data, 'admin');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Security::validateCsrf();
            $_POST = Security::xssClean($_POST);
            
            $profile_image = 'default-doctor.jpg';
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../public/assets/images/doctors/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = time() . '_' . basename($_FILES['profile_image']['name']);
                $targetFilePath = $uploadDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp');
                if (in_array(strtolower($fileType), $allowTypes)) {
                    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFilePath)) {
                        $profile_image = $fileName;
                    }
                }
            }
            
            $data = [
                'prefix' => trim($_POST['prefix']),
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'profile_image' => $profile_image,
                'position' => trim($_POST['position']),
                'specialty' => trim($_POST['specialty']),
                'biography' => trim($_POST['biography']),
                'status' => trim($_POST['status'])
            ];

            if ($this->doctorModel->create($data)) {
                $this->redirect('admin/doctors');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function edit($id) {
        $doctor = $this->doctorModel->getById($id);

        $data = [
            'page_title' => 'แก้ไขแพทย์',
            'doctor' => $doctor
        ];
        $this->view('admin/doctors/edit', $data, 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Security::validateCsrf();
            $_POST = Security::xssClean($_POST);
            
            // Existing image
            $doctor = $this->doctorModel->getById($id);
            $profile_image = $doctor->profile_image;
            
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../public/assets/images/doctors/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = time() . '_' . basename($_FILES['profile_image']['name']);
                $targetFilePath = $uploadDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp');
                if (in_array(strtolower($fileType), $allowTypes)) {
                    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFilePath)) {
                        $profile_image = $fileName;
                        
                        // Delete old image if it's not the default
                        if ($doctor->profile_image != 'default-doctor.jpg' && file_exists($uploadDir . $doctor->profile_image)) {
                            unlink($uploadDir . $doctor->profile_image);
                        }
                    }
                }
            }
            
            $data = [
                'id' => $id,
                'prefix' => trim($_POST['prefix']),
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'profile_image' => $profile_image,
                'position' => trim($_POST['position']),
                'specialty' => trim($_POST['specialty']),
                'biography' => trim($_POST['biography']),
                'status' => trim($_POST['status'])
            ];

            if ($this->doctorModel->update($data)) {
                $this->redirect('admin/doctors');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Security::validateCsrf();
            if ($this->doctorModel->delete($id)) {
                $this->redirect('admin/doctors');
            } else {
                die('Something went wrong');
            }
        }
    }
}
