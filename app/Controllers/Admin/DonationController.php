<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

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
        }

        $data = [
            'page_title' => 'รายละเอียดการบริจาค',
            'donation' => $donation
        ];
        $this->view('admin/donations/list/show', $data, 'admin');
    }

    public function updateStatus($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            $status = $_POST['status'];
            $adminNote = trim($_POST['admin_note']);

            $donation = $this->donationModel->getById($id);
            if (!$donation) {
                die('Donation not found');
            }

            // If we are approving a donation, we need to update the total accumulated in donation_items
            if ($status == 'approved' && $donation->status != 'approved') {
                // Update amount or quantity
                $item = $this->itemModel->getById($donation->donation_item_id);
                
                // This would be better inside a transaction but for simplicity we do it here
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

            if ($this->donationModel->updateStatus($id, $status, $adminNote)) {
                $this->redirect('admin/donation/show/' . $id);
            } else {
                die('Something went wrong');
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->donationModel->delete($id)) {
                $this->redirect('admin/donation');
            } else {
                die('Something went wrong');
            }
        }
    }
}
