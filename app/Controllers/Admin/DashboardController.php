<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class DashboardController extends Controller {
    
    public function __construct() {
        AuthMiddleware::check();
    }

    public function index() {
        // We can just use raw queries here for quick dashboard stats
        $db = new \App\Core\Database();
        
        // Count total news
        $db->query('SELECT COUNT(*) as total FROM news WHERE deleted_at IS NULL');
        $newsCount = $db->single()->total;
        
        // Count total doctors
        $db->query('SELECT COUNT(*) as total FROM doctors WHERE deleted_at IS NULL');
        $doctorCount = $db->single()->total;
        
        // Count pending complaints
        $db->query('SELECT COUNT(*) as total FROM complaints WHERE status = "pending"');
        $pendingComplaintCount = $db->single()->total;

        // Get latest news
        $db->query('SELECT * FROM news WHERE deleted_at IS NULL ORDER BY created_at DESC LIMIT 5');
        $latestNews = $db->resultSet();
        
        $data = [
            'page_title' => 'Dashboard',
            'newsCount' => $newsCount,
            'doctorCount' => $doctorCount,
            'pendingComplaintCount' => $pendingComplaintCount,
            'latestNews' => $latestNews
        ];
        
        $this->view('admin/dashboard', $data, 'admin');
    }
}
