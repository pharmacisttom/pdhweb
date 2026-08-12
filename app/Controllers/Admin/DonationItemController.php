<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class DonationItemController extends Controller {
    
    private $itemModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->itemModel = $this->model('DonationItem');
    }

    public function index() {
        $items = $this->itemModel->getAll();
        $data = [
            'page_title' => 'จัดการรายการรับบริจาค',
            'items' => $items
        ];
        
        $this->view('admin/donations/items/index', $data, 'admin');
    }

    public function create() {
        $data = [
            'page_title' => 'เพิ่มรายการรับบริจาค'
        ];
        $this->view('admin/donations/items/create', $data, 'admin');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            $image = 'default-donation.jpg';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../public/assets/images/donations/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $fileName = time() . '_' . substr(md5(uniqid()), 0, 8) . '.' . $fileType;
                $targetFilePath = $uploadDir . $fileName;
                
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp', 'jfif');
                if (in_array(strtolower($fileType), $allowTypes)) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                        $image = $fileName;
                    }
                }
            }

            $data = [
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'type' => trim($_POST['type']),
                'target_amount' => $_POST['target_amount'] ?? null,
                'target_quantity' => $_POST['target_quantity'] ?? null,
                'image' => $image,
                'status' => trim($_POST['status'])
            ];

            if ($this->itemModel->create($data)) {
                $this->redirect('admin/donationitem');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function edit($id) {
        $item = $this->itemModel->getById($id);

        $data = [
            'page_title' => 'แก้ไขรายการรับบริจาค',
            'item' => $item
        ];
        $this->view('admin/donations/items/edit', $data, 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            $item = $this->itemModel->getById($id);
            $image = $item->image;
            
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../public/assets/images/donations/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $fileName = time() . '_' . substr(md5(uniqid()), 0, 8) . '.' . $fileType;
                $targetFilePath = $uploadDir . $fileName;
                
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp', 'jfif');
                if (in_array(strtolower($fileType), $allowTypes)) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                        $image = $fileName;
                        
                        if ($item->image != 'default-donation.jpg' && file_exists($uploadDir . $item->image)) {
                            unlink($uploadDir . $item->image);
                        }
                    }
                }
            }

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'type' => trim($_POST['type']),
                'target_amount' => $_POST['target_amount'] ?? null,
                'target_quantity' => $_POST['target_quantity'] ?? null,
                'status' => trim($_POST['status']),
                'image' => $image
            ];

            if ($this->itemModel->update($data)) {
                $this->redirect('admin/donationitem');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->itemModel->delete($id)) {
                $this->redirect('admin/donationitem');
            } else {
                die('Something went wrong');
            }
        }
    }
}
