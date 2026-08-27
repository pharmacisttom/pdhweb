<?php
namespace App\Controllers;

use App\Core\Controller;

class ProcurementController extends Controller {
    
    private $procurementModel;

    public function __construct() {
        $this->procurementModel = $this->model('Procurement');
    }

    public function index() {
        $filters = [
            'category' => trim($_GET['category'] ?? ''),
            'budget_year' => preg_match('/^25\d{2}$/', $_GET['budget_year'] ?? '') ? $_GET['budget_year'] : '',
            'search' => trim($_GET['q'] ?? '')
        ];
        $procurements = $this->procurementModel->getPublished($filters);
        
        $data = [
            'page_title' => 'ประกาศจัดซื้อจัดจ้าง',
            'procurements' => $procurements,
            'selected_category' => $filters['category'],
            'selected_budget_year' => $filters['budget_year'],
            'search_query' => $filters['search'],
            'categories' => $this->procurementModel->getCategories(),
            'budgetYears' => $this->procurementModel->getBudgetYears()
        ];
        
        $this->view('procurement/index', $data);
    }

    public function show($id) {
        $procurement = $this->procurementModel->getPublishedById($id);
        if (!$procurement) {
            http_response_code(404);
            $this->view('pages/404', ['page_title' => 'ไม่พบประกาศที่ต้องการ']);
            return;
        }
        $this->view('procurement/show', ['page_title' => $procurement->title, 'procurement' => $procurement]);
    }
}
