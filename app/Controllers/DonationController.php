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

            // Generate unique tracking code (Format: PDH-DON-YYYYMMDD-XXXX)
            $tracking_code = 'PDH-DON-' . date('Ymd') . '-' . strtoupper(substr(bin2hex(random_bytes(2)), 0, 4));

            $data = [
                'donation_item_id' => $itemId,
                'tracking_code' => $tracking_code,
                'donor_name' => trim($_POST['donor_name']),
                'donor_email' => trim($_POST['donor_email'] ?? ''),
                'donor_phone' => trim($_POST['donor_phone'] ?? ''),
                'amount' => ($item->type == 'money' || $item->type == 'general') ? (!empty($_POST['amount']) ? str_replace(',', '', $_POST['amount']) : null) : null,
                'quantity' => ($item->type == 'equipment') ? $_POST['quantity'] : null,
                'payment_slip_image' => $payment_slip_image
            ];

            if ($this->donationModel->create($data)) {
                $_SESSION['flash_success'] = "ขอบคุณสำหรับการร่วมบริจาคของท่าน ข้อมูลและหลักฐานถูกบันทึกเรียบร้อยแล้ว";
                $this->redirect('donation/success/' . $tracking_code);
            } else {
                die('Something went wrong. Please try again.');
            }
        }
    }

    /**
     * Donation Success Confirmation Page
     */
    public function success($tracking_code = '') {
        if (empty($tracking_code)) {
            $this->redirect('donation');
            return;
        }

        $donation = $this->donationModel->getByTrackingCode($tracking_code);
        if (!$donation) {
            $this->redirect('donation');
            return;
        }

        $data = [
            'title' => 'ส่งหลักฐานการบริจาคสำเร็จ | โรงพยาบาลปลวกแดง',
            'page_title' => 'ร่วมบริจาคสำเร็จ - ขอขอบพระคุณเป็นอย่างยิ่ง',
            'tracking_code' => $tracking_code,
            'donation' => $donation
        ];

        $this->view('donations/success', $data);
    }

    /**
     * Donor Tracker (ตรวจสอบสถานะการบริจาค)
     */
    public function track() {
        $keyword = trim($_GET['code'] ?? $_GET['search'] ?? '');
        $results = [];
        $searched = !empty($keyword);

        if ($searched) {
            $results = $this->donationModel->searchByKeyword($keyword);
        }

        $data = [
            'title' => 'ติดตามสถานะการบริจาค (Donor Tracker) | โรงพยาบาลปลวกแดง',
            'page_title' => 'ระบบตรวจสอบและติดตามสถานะการบริจาค',
            'keyword' => $keyword,
            'searched' => $searched,
            'results' => $results
        ];

        $this->view('donations/track', $data);
    }

    /**
     * Dynamic PromptPay e-Donation QR Helper JSON Endpoint
     */
    public function qr() {
        header('Content-Type: application/json');
        $amount = isset($_GET['amount']) ? floatval($_GET['amount']) : 0;
        $ref1 = isset($_GET['ref']) ? trim($_GET['ref']) : '';

        $payload = \App\Helpers\PromptPayHelper::generateEDonationPayload($amount, $ref1);
        $qrImageUrl = \App\Helpers\PromptPayHelper::getQrImageUrl($amount, $ref1, 300);

        echo json_encode([
            'success' => true,
            'amount' => $amount,
            'formatted_amount' => number_format($amount, 2),
            'payload' => $payload,
            'qr_image_url' => $qrImageUrl,
            'biller_id' => \App\Helpers\PromptPayHelper::BILLER_ID
        ]);
        exit;
    }
}
