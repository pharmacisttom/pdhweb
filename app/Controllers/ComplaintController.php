<?php
namespace App\Controllers;

use App\Core\Controller;

class ComplaintController extends Controller {
    
    private $complaintModel;

    public function __construct() {
        $this->complaintModel = $this->model('Complaint');
    }

    public function index() {
        $data = [
            'page_title' => 'รับเรื่องร้องเรียน / เสนอแนะ'
        ];
        
        $this->view('complaint/index', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            // Generate a unique tracking code (e.g., PDH-20231015-ABCD)
            $tracking_code = 'PDH-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 4));

            $data = [
                'tracking_code' => $tracking_code,
                'fullname' => trim($_POST['fullname']),
                'contact_info' => trim($_POST['contact_info']),
                'topic' => trim($_POST['topic']),
                'message' => trim($_POST['message']),
                'is_anonymous' => isset($_POST['is_anonymous']) ? 1 : 0
            ];

            if ($this->complaintModel->create($data)) {
                $this->redirect('complaint/success/' . $tracking_code);
            } else {
                die('Something went wrong');
            }
        }
    }

    public function success($tracking_code = '') {
        if(empty($tracking_code)) {
            $this->redirect('complaint');
        }

        $data = [
            'page_title' => 'ส่งเรื่องร้องเรียนสำเร็จ',
            'tracking_code' => $tracking_code
        ];
        $this->view('complaint/success', $data);
    }

    public function track() {
        $tracking_code = $_GET['code'] ?? '';
        $complaint = null;

        if(!empty($tracking_code)) {
            $complaint = $this->complaintModel->getByTrackingCode($tracking_code);
        }

        $data = [
            'page_title' => 'ติดตามสถานะเรื่องร้องเรียน',
            'tracking_code' => $tracking_code,
            'complaint' => $complaint
        ];
        
        $this->view('complaint/track', $data);
    }
}
