<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Helpers\Security;

class ProcurementController extends Controller {
    
    private $procurementModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->procurementModel = $this->model('Procurement');
    }

    public function index() {
        $procurements = $this->procurementModel->getAll();
        
        $data = [
            'page_title' => 'จัดการข้อมูลจัดซื้อจัดจ้าง',
            'procurements' => $procurements
        ];
        
        $this->view('admin/procurements/index', $data, 'admin');
    }

    public function create() {
        $data = [
            'page_title' => 'เพิ่มประกาศจัดซื้อจัดจ้าง'
        ];
        $this->view('admin/procurements/create', $data, 'admin');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Security::validateCsrf();
            $_POST = Security::xssClean($_POST);
            
            $document_url = null;
            if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../public/assets/uploads/procurements/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $origName = basename($_FILES['document']['name']);
                $fileType = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                $fileName = time() . '_' . substr(md5(uniqid()), 0, 8) . '.' . $fileType;
                $targetFilePath = $uploadDir . $fileName;
                
                $allowTypes = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip', 'rar');
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES['document']['tmp_name'], $targetFilePath)) {
                        $document_url = $fileName;
                    }
                }
            }

            $data = [
                'title' => trim($_POST['title']),
                'project_budget' => !empty($_POST['project_budget']) ? str_replace(',', '', trim($_POST['project_budget'])) : null,
                'category' => trim($_POST['category']),
                'status' => trim($_POST['status'] ?? 'active'),
                'published_at' => trim($_POST['published_at'] ?? date('Y-m-d')),
                'document_url' => $document_url
            ];

            if ($this->procurementModel->create($data)) {
                $this->redirect('admin/procurement');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function edit($id) {
        $procurement = $this->procurementModel->getById($id);

        if (!$procurement) {
            $this->redirect('admin/procurement');
            return;
        }

        $data = [
            'page_title' => 'แก้ไขข้อมูลจัดซื้อจัดจ้าง',
            'procurement' => $procurement
        ];
        $this->view('admin/procurements/edit', $data, 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Security::validateCsrf();
            $_POST = Security::xssClean($_POST);

            $procurement = $this->procurementModel->getById($id);
            $document_url = $procurement->document_url ?? null;

            if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../public/assets/uploads/procurements/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $origName = basename($_FILES['document']['name']);
                $fileType = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                $fileName = time() . '_' . substr(md5(uniqid()), 0, 8) . '.' . $fileType;
                $targetFilePath = $uploadDir . $fileName;
                
                $allowTypes = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip', 'rar');
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES['document']['tmp_name'], $targetFilePath)) {
                        $document_url = $fileName;
                        
                        if (!empty($procurement->document_url) && file_exists($uploadDir . $procurement->document_url)) {
                            @unlink($uploadDir . $procurement->document_url);
                        }
                    }
                }
            }
            
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'project_budget' => !empty($_POST['project_budget']) ? str_replace(',', '', trim($_POST['project_budget'])) : null,
                'category' => trim($_POST['category']),
                'status' => trim($_POST['status'] ?? 'active'),
                'published_at' => trim($_POST['published_at'] ?? date('Y-m-d')),
                'document_url' => $document_url
            ];

            if ($this->procurementModel->update($data)) {
                $this->redirect('admin/procurement');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Security::validateCsrf();
            if ($this->procurementModel->delete($id)) {
                $this->redirect('admin/procurement');
            } else {
                die('Something went wrong');
            }
        }
    }
}
