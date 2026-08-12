<?php
namespace App\Controllers;

use App\Core\Controller;

class ProcurementController extends Controller {
    
    private $procurementModel;

    public function __construct() {
        $this->procurementModel = $this->model('Procurement');
    }

    public function index() {
        $category = $_GET['category'] ?? null;
        
        $procurements = $this->procurementModel->getAll($category);
        
        $data = [
            'page_title' => 'ประกาศจัดซื้อจัดจ้าง',
            'procurements' => $procurements,
            'selected_category' => $category
        ];
        
        $this->view('procurement/index', $data);
    }
}
