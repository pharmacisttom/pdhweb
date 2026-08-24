<?php
namespace App\Controllers;

use App\Core\Controller;

class DonationController extends Controller {
    
    private $itemModel;
    private $donationModel;

    public function __construct() {
        $this->itemModel = $this->model('DonationItem');
        $this->donationModel = $this->model('Donation');
    }

    public function index() {
        $items = $this->itemModel->getActive();
        $recentDonors = $this->donationModel->getRecentApproved(8);

        $totalRaised = 0;
        $totalTarget = 0;
        foreach ($items as $it) {
            $totalRaised += floatval($it->current_amount ?? 0);
            $totalTarget += floatval($it->target_amount ?? 0);
        }

        $data = [
            'title' => 'การให้ไม่มีสิ้นสุด (The Endless Giving) | ร่วมบริจาคโรงพยาบาลปลวกแดง',
            'page_title' => 'แคมเปญการให้ไม่มีสิ้นสุด (The Endless Giving) - โรงพยาบาลปลวกแดง',
            'og_description' => 'ร่วมบริจาคสมทบทุนจัดซื้อเครื่องมือแพทย์และช่วยเหลือผู้ป่วยยากไร้ โรงพยาบาลปลวกแดง ผ่านแคมเปญการให้ไม่มีสิ้นสุด ลดหย่อนภาษีได้ 2 เท่าผ่านระบบ e-Donation',
            'items' => $items,
            'recentDonors' => $recentDonors,
            'totalRaised' => $totalRaised,
            'totalTarget' => $totalTarget
        ];
        
        $this->view('donations/index', $data);
    }

    public function show($id) {
        $item = $this->itemModel->getById($id);
        
        if (!$item) {
            $this->redirect('donation');
        }

        $data = [
            'page_title' => $item->title,
            'og_type' => 'website',
            'og_description' => strip_tags($item->description),
            'og_image' => URLROOT . '/assets/images/donations/' . $item->image,
            'item' => $item
        ];
        $this->view('donations/show', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            $itemId = $_POST['donation_item_id'];
            $item = $this->itemModel->getById($itemId);
            
            if (!$item) {
                die('Invalid item');
            }

            $payment_slip_image = null;
            if (isset($_FILES['payment_slip']) && $_FILES['payment_slip']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../public/assets/images/slips/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = time() . '_' . basename($_FILES['payment_slip']['name']);
                $targetFilePath = $uploadDir . $fileName;
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $fileName = time() . '_' . substr(md5(uniqid()), 0, 8) . '.' . $fileType;
                $targetFilePath = $uploadDir . $fileName;
                
                $allowTypes = array('jpg', 'png', 'jpeg', 'webp', 'jfif');
                if (in_array(strtolower($fileType), $allowTypes)) {
                    if (move_uploaded_file($_FILES['payment_slip']['tmp_name'], $targetFilePath)) {
                        $payment_slip_image = $fileName;
                    }
                }
            }

            $data = [
                'donation_item_id' => $itemId,
                'donor_name' => trim($_POST['donor_name']),
                'donor_email' => trim($_POST['donor_email']),
                'donor_phone' => trim($_POST['donor_phone']),
                'amount' => ($item->type == 'money' || $item->type == 'general') ? $_POST['amount'] : null,
                'quantity' => ($item->type == 'equipment') ? $_POST['quantity'] : null,
                'payment_slip_image' => $payment_slip_image
            ];

            if ($this->donationModel->create($data)) {
                // Flash message should ideally be used here
                $_SESSION['flash_message'] = "ขอบคุณสำหรับการบริจาคของคุณ ทางเราได้รับข้อมูลเรียบร้อยแล้ว และจะทำการตรวจสอบต่อไป";
                $this->redirect('donation/show/' . $itemId);
            } else {
                die('Something went wrong');
            }
        }
    }
}
