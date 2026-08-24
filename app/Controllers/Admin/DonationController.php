<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Helpers\Security;

class DonationController extends Controller {
    
    private $donationModel;
    private $itemModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->donationModel = $this->model('Donation');
        $this->itemModel = $this->model('DonationItem');
    }

    public function index() {
        $donations = $this->donationModel->getAll();
        $data = [
            'page_title' => 'ตรวจสอบการบริจาค',
            'donations' => $donations
        ];
        
        $this->view('admin/donations/list/index', $data, 'admin');
    }

    public function show($id) {
        $donation = $this->donationModel->getById($id);
        
        if (!$donation) {
            $this->redirect('admin/donation');
            return;
        }

        $data = [
            'page_title' => 'รายละเอียดการบริจาค',
            'donation' => $donation
        ];
        $this->view('admin/donations/list/show', $data, 'admin');
    }

    public function edit($id) {
        $donation = $this->donationModel->getById($id);
        
        if (!$donation) {
            $this->redirect('admin/donation');
            return;
        }

        $items = $this->itemModel->getAll();

        $data = [
            'page_title' => 'แก้ไขข้อมูลการบริจาค',
            'donation' => $donation,
            'items' => $items
        ];
        $this->view('admin/donations/list/edit', $data, 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Security::validateCsrf();
            $_POST = Security::xssClean($_POST);

            $donation = $this->donationModel->getById($id);
            if (!$donation) {
                $this->redirect('admin/donation');
                return;
            }

            $payment_slip_image = null;
            if (isset($_FILES['payment_slip_image']) && $_FILES['payment_slip_image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../public/assets/images/slips/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $origName = basename($_FILES['payment_slip_image']['name']);
                $fileType = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                $fileName = time() . '_' . substr(md5(uniqid()), 0, 8) . '.' . $fileType;
                $targetFilePath = $uploadDir . $fileName;
                
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp', 'jfif');
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES['payment_slip_image']['tmp_name'], $targetFilePath)) {
                        $payment_slip_image = $fileName;
                        
                        if (!empty($donation->payment_slip_image) && file_exists($uploadDir . $donation->payment_slip_image)) {
                            @unlink($uploadDir . $donation->payment_slip_image);
                        }
                    }
                }
            }

            $newStatus = trim($_POST['status'] ?? 'pending');
            $newAmount = !empty($_POST['amount']) ? str_replace(',', '', trim($_POST['amount'])) : null;
            $newQuantity = !empty($_POST['quantity']) ? str_replace(',', '', trim($_POST['quantity'])) : null;

            // Check if status is transitioning to approved
            if ($newStatus == 'approved' && $donation->status != 'approved') {
                $item = $this->itemModel->getById($_POST['donation_item_id']);
                if ($item) {
                    $db = new \App\Core\Database();
                    if ($item->type == 'money' || $item->type == 'general') {
                        $accumAmount = ($item->current_amount ?? 0) + ($newAmount ?? 0);
                        $db->query('UPDATE donation_items SET current_amount = :amount WHERE id = :id');
                        $db->bind(':amount', $accumAmount);
                        $db->bind(':id', $item->id);
                        $db->execute();
                    } else if ($item->type == 'equipment') {
                        $accumQty = ($item->current_quantity ?? 0) + ($newQuantity ?? 0);
                        $db->query('UPDATE donation_items SET current_quantity = :qty WHERE id = :id');
                        $db->bind(':qty', $accumQty);
                        $db->bind(':id', $item->id);
                        $db->execute();
                    }
                }
            }

            $data = [
                'id' => $id,
                'donation_item_id' => $_POST['donation_item_id'],
                'donor_name' => trim($_POST['donor_name']),
                'donor_email' => trim($_POST['donor_email'] ?? ''),
                'donor_phone' => trim($_POST['donor_phone'] ?? ''),
                'amount' => $newAmount,
                'quantity' => $newQuantity,
                'status' => $newStatus,
                'admin_note' => trim($_POST['admin_note'] ?? ''),
                'payment_slip_image' => $payment_slip_image
            ];

            if ($this->donationModel->update($data)) {
                $this->redirect('admin/donation');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function updateStatus($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Security::validateCsrf();
            $_POST = Security::xssClean($_POST);
            
            $status = $_POST['status'];
            $adminNote = trim($_POST['admin_note']);

            $donation = $this->donationModel->getById($id);
            if (!$donation) {
                die('Donation not found');
            }

            // If we are approving a donation, we need to update the total accumulated in donation_items
            if ($status == 'approved' && $donation->status != 'approved') {
                $item = $this->itemModel->getById($donation->donation_item_id);
                if ($item) {
                    $db = new \App\Core\Database();
                    if ($item->type == 'money' || $item->type == 'general') {
                        $newAmount = $item->current_amount + $donation->amount;
                        $db->query('UPDATE donation_items SET current_amount = :amount WHERE id = :id');
                        $db->bind(':amount', $newAmount);
                        $db->bind(':id', $item->id);
                        $db->execute();
                    } else if ($item->type == 'equipment') {
                        $newQuantity = $item->current_quantity + $donation->quantity;
                        $db->query('UPDATE donation_items SET current_quantity = :qty WHERE id = :id');
                        $db->bind(':qty', $newQuantity);
                        $db->bind(':id', $item->id);
                        $db->execute();
                    }
                }
            }

            if ($this->donationModel->updateStatus($id, $status, $adminNote)) {
                $this->redirect('admin/donation/show/' . $id);
            } else {
                die('Something went wrong');
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Security::validateCsrf();
            $donation = $this->donationModel->getById($id);
            if ($donation) {
                if (!empty($donation->payment_slip_image)) {
                    $uploadDir = '../public/assets/images/slips/';
                    if (file_exists($uploadDir . $donation->payment_slip_image)) {
                        @unlink($uploadDir . $donation->payment_slip_image);
                    }
                }
            }

            if ($this->donationModel->delete($id)) {
                $this->redirect('admin/donation');
            } else {
                die('Something went wrong');
            }
        }
    }
}
