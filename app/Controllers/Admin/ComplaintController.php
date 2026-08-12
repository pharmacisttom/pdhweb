<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class ComplaintController extends Controller {
    
    private $complaintModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->complaintModel = $this->model('Complaint');
    }

    public function index() {
        $complaints = $this->complaintModel->getAll();
        
        $data = [
            'page_title' => 'จัดการเรื่องร้องเรียน',
            'complaints' => $complaints
        ];
        
        $this->view('admin/complaints/index', $data, 'admin');
    }

    public function show($id) {
        $complaint = $this->complaintModel->getById($id);

        $data = [
            'page_title' => 'รายละเอียดข้อร้องเรียน',
            'complaint' => $complaint
        ];
        
        $this->view('admin/complaints/show', $data, 'admin');
    }

    public function updateStatus($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            $status = trim($_POST['status']);
            $admin_response = !empty($_POST['admin_response']) ? trim($_POST['admin_response']) : null;
            
            if ($this->complaintModel->updateStatus($id, $status, $admin_response)) {
                $this->redirect('admin/complaints/show/' . $id);
            } else {
                die('Something went wrong');
            }
        }
    }
}
