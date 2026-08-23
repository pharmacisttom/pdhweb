<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class BannerController extends Controller {
    
    private $bannerModel;
    private $db;

    public function __construct() {
        AuthMiddleware::check();
        $this->bannerModel = $this->model('Banner');
        $this->db = new \App\Core\Database();
    }

    public function index() {
        $banners = $this->bannerModel->getAll();
        
        $this->db->query("SELECT setting_key, setting_value FROM settings WHERE setting_key IN ('banner_slider_interval', 'banner_transition_effect')");
        $sliderSettingsRaw = $this->db->resultSet();
        $sliderSettings = [];
        foreach ($sliderSettingsRaw as $s) {
            $sliderSettings[$s->setting_key] = $s->setting_value;
        }

        $data = [
            'page_title' => 'จัดการป้ายแบนเนอร์ & สไลเดอร์ (Banner Carousel Management)',
            'banners' => $banners,
            'slider_interval' => $sliderSettings['banner_slider_interval'] ?? '5000',
            'transition_effect' => $sliderSettings['banner_transition_effect'] ?? 'fade'
        ];
        
        $this->view('admin/banners/index', $data, 'admin');
    }

    public function toggle($id) {
        if ($this->isPost()) {
            \App\Helpers\Security::validateCsrf();
            $this->bannerModel->toggleStatus($id);
            $this->setFlash('banner_success', 'สลับสถานะการแสดงผลแบนเนอร์เรียบร้อยแล้ว');
            $this->redirect('admin/banner');
        }
    }

    public function move($id, $direction = 'up') {
        if ($this->isPost()) {
            \App\Helpers\Security::validateCsrf();
            $this->bannerModel->moveOrder($id, $direction);
            $this->setFlash('banner_success', 'สลับลำดับการแสดงผลแบนเนอร์เรียบร้อยแล้ว');
            $this->redirect('admin/banner');
        }
    }

    public function updateSliderSettings() {
        if ($this->isPost()) {
            \App\Helpers\Security::validateCsrf();
            $interval = (int)($_POST['banner_slider_interval'] ?? 5000);
            $effect = $_POST['banner_transition_effect'] ?? 'fade';

            $this->db->query("INSERT INTO settings (setting_key, setting_value) VALUES ('banner_slider_interval', :v) ON DUPLICATE KEY UPDATE setting_value = :v2");
            $this->db->bind(':v', $interval);
            $this->db->bind(':v2', $interval);
            $this->db->execute();

            $this->db->query("INSERT INTO settings (setting_key, setting_value) VALUES ('banner_transition_effect', :e) ON DUPLICATE KEY UPDATE setting_value = :e2");
            $this->db->bind(':e', $effect);
            $this->db->bind(':e2', $effect);
            $this->db->execute();

            $this->setFlash('banner_success', 'บันทึกการตั้งค่าระบบสลับแบนเนอร์เรียบร้อยแล้ว');
            $this->redirect('admin/banner');
        }
    }

    public function create() {
        $data = [
            'page_title' => 'เพิ่มรูปแบนเนอร์ใหม่'
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
                $fileType = strtolower(pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION));
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
                $this->setFlash('banner_error', 'กรุณาอัปโหลดรูปภาพที่ถูกต้อง (JPG, PNG, WebP)', 'warning');
                $this->redirect('admin/banner/create');
                return;
            }

            $data = [
                'title' => trim($_POST['title']),
                'link' => trim($_POST['link'] ?? ''),
                'sort_order' => (int)($_POST['sort_order'] ?? 0),
                'status' => trim($_POST['status'] ?? 'active'),
                'image_file' => $image_file
            ];

            if ($this->bannerModel->create($data)) {
                $this->setFlash('banner_success', 'เพิ่มแบนเนอร์ใหม่เรียบร้อยแล้ว');
                $this->redirect('admin/banner');
            } else {
                $this->setFlash('banner_error', 'เกิดข้อผิดพลาดในการบันทึก', 'danger');
                $this->redirect('admin/banner/create');
            }
        }
    }

    public function edit($id) {
        $banner = $this->bannerModel->getById($id);
        if (!$banner) {
            $this->redirect('admin/banner');
        }

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
                $fileType = strtolower(pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION));
                $fileName = time() . '_' . substr(md5(uniqid()), 0, 8) . '.' . $fileType;
                $targetFilePath = $uploadDir . $fileName;
                
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp', 'jfif');
                if (in_array(strtolower($fileType), $allowTypes)) {
                    if (move_uploaded_file($_FILES['image_file']['tmp_name'], $targetFilePath)) {
                        $image_file = $fileName;
                        
                        if (!empty($banner->image_file) && file_exists($uploadDir . $banner->image_file)) {
                            @unlink($uploadDir . $banner->image_file);
                        }
                    }
                }
            }

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'link' => trim($_POST['link'] ?? ''),
                'sort_order' => (int)($_POST['sort_order'] ?? 0),
                'status' => trim($_POST['status'] ?? 'active'),
                'image_file' => $image_file
            ];

            if ($this->bannerModel->update($data)) {
                $this->setFlash('banner_success', 'อัปเดตข้อมูลแบนเนอร์เรียบร้อยแล้ว');
                $this->redirect('admin/banner');
            } else {
                $this->setFlash('banner_error', 'เกิดข้อผิดพลาดในการอัปเดต', 'danger');
                $this->redirect('admin/banner/edit/' . $id);
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $banner = $this->bannerModel->getById($id);
            $uploadDir = '../public/assets/images/banners/';
            
            if ($this->bannerModel->delete($id)) {
                if (!empty($banner->image_file) && file_exists($uploadDir . $banner->image_file)) {
                    @unlink($uploadDir . $banner->image_file);
                }
                $this->setFlash('banner_success', 'ลบแบนเนอร์เรียบร้อยแล้ว');
                $this->redirect('admin/banner');
            } else {
                $this->redirect('admin/banner');
            }
        }
    }
}
