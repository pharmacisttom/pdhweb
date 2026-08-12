<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class BannerController extends Controller {
    
    private $bannerModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->bannerModel = $this->model('Banner');
    }

    public function index() {
        $banners = $this->bannerModel->getAll();
        $data = [
            'page_title' => 'จัดการป้ายแบนเนอร์',
            'banners' => $banners
        ];
        
        $this->view('admin/banners/index', $data, 'admin');
    }

    public function create() {
        $data = [
            'page_title' => 'เพิ่มรูปแบนเนอร์'
        ];
        $this->view('admin/banners/create', $data, 'admin');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            $image_file = '';
            if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../public/assets/images/banners/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = time() . '_' . basename($_FILES['image_file']['name']);
                $targetFilePath = $uploadDir . $fileName;
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $fileName = time() . '_' . substr(md5(uniqid()), 0, 8) . '.' . $fileType;
                $targetFilePath = $uploadDir . $fileName;
                
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp', 'jfif');
                if (in_array(strtolower($fileType), $allowTypes)) {
                    if (move_uploaded_file($_FILES['image_file']['tmp_name'], $targetFilePath)) {
                        $image_file = $fileName;
                    }
                }
            }

            if (empty($image_file)) {
                die('กรุณาอัปโหลดรูปภาพที่ถูกต้อง');
            }

            $data = [
                'title' => trim($_POST['title']),
                'link' => trim($_POST['link']),
                'sort_order' => (int)$_POST['sort_order'],
                'status' => trim($_POST['status']),
                'image_file' => $image_file
            ];

            if ($this->bannerModel->create($data)) {
                $this->redirect('admin/banner');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function edit($id) {
        $banner = $this->bannerModel->getById($id);

        $data = [
            'page_title' => 'แก้ไขแบนเนอร์',
            'banner' => $banner
        ];
        $this->view('admin/banners/edit', $data, 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            $banner = $this->bannerModel->getById($id);
            $image_file = $banner->image_file;
            
            if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../public/assets/images/banners/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = time() . '_' . basename($_FILES['image_file']['name']);
                $targetFilePath = $uploadDir . $fileName;
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $fileName = time() . '_' . substr(md5(uniqid()), 0, 8) . '.' . $fileType;
                $targetFilePath = $uploadDir . $fileName;
                
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp', 'jfif');
                if (in_array(strtolower($fileType), $allowTypes)) {
                    if (move_uploaded_file($_FILES['image_file']['tmp_name'], $targetFilePath)) {
                        $image_file = $fileName;
                        
                        if (file_exists($uploadDir . $banner->image_file)) {
                            unlink($uploadDir . $banner->image_file);
                        }
                    }
                }
            }

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'link' => trim($_POST['link']),
                'sort_order' => (int)$_POST['sort_order'],
                'status' => trim($_POST['status']),
                'image_file' => $image_file
            ];

            if ($this->bannerModel->update($data)) {
                $this->redirect('admin/banner');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $banner = $this->bannerModel->getById($id);
            $uploadDir = '../public/assets/images/banners/';
            
            if ($this->bannerModel->delete($id)) {
                if (file_exists($uploadDir . $banner->image_file)) {
                    unlink($uploadDir . $banner->image_file);
                }
                $this->redirect('admin/banner');
            } else {
                die('Something went wrong');
            }
        }
    }
}
