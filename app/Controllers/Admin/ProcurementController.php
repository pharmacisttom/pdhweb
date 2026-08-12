<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

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
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            // Dummy file logic for now
            $document_url = null;
            if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
                // Should implement real upload
                $document_url = time() . '_' . $_FILES['document']['name'];
            }

            $data = [
                'title' => trim($_POST['title']),
                'project_budget' => !empty($_POST['project_budget']) ? str_replace(',', '', trim($_POST['project_budget'])) : null,
                'category' => trim($_POST['category']),
                'status' => trim($_POST['status']),
                'published_at' => trim($_POST['published_at']),
                'document_url' => $document_url
            ];

            if ($this->procurementModel->create($data)) {
                $this->redirect('admin/procurements');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function edit($id) {
        $procurement = $this->procurementModel->getById($id);

        $data = [
            'page_title' => 'แก้ไขข้อมูลจัดซื้อจัดจ้าง',
            'procurement' => $procurement
        ];
        $this->view('admin/procurements/edit', $data, 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'project_budget' => !empty($_POST['project_budget']) ? str_replace(',', '', trim($_POST['project_budget'])) : null,
                'category' => trim($_POST['category']),
                'status' => trim($_POST['status']),
                'published_at' => trim($_POST['published_at'])
            ];

            if ($this->procurementModel->update($data)) {
                $this->redirect('admin/procurements');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->procurementModel->delete($id)) {
                $this->redirect('admin/procurements');
            } else {
                die('Something went wrong');
            }
        }
    }
}
