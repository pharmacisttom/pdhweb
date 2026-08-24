<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Helpers\TrackerHelper;

class DashboardController extends Controller {
    
    public function __construct() {
        AuthMiddleware::check();
    }

    public function index() {
        $db = new \App\Core\Database();
        
        // Count total news
        $db->query('SELECT COUNT(*) as total FROM news WHERE deleted_at IS NULL');
        $newsCount = $db->single()->total ?? 0;
        
        // Count total doctors
        $db->query('SELECT COUNT(*) as total FROM doctors WHERE deleted_at IS NULL');
        $doctorCount = $db->single()->total ?? 0;
        
        // Count pending complaints
        $db->query('SELECT COUNT(*) as total FROM complaints WHERE status = "pending"');
        $pendingComplaintCount = $db->single()->total ?? 0;

        // Count pending donations & total raised
        $db->query('SELECT COUNT(*) as pending_slips, COALESCE(SUM(amount), 0) as total_raised FROM donations WHERE status = "approved"');
        $donStats = $db->single();
        $totalDonationAmount = $donStats->total_raised ?? 0;

        $db->query('SELECT COUNT(*) as pending_slips FROM donations WHERE status = "pending"');
        $pendingDonationCount = $db->single()->pending_slips ?? 0;

        // Get latest news
        $db->query('SELECT * FROM news WHERE deleted_at IS NULL ORDER BY created_at DESC LIMIT 5');
        $latestNews = $db->resultSet() ?: [];

        // Get visitor and service usage statistics
        $visitStats = TrackerHelper::getStats();
        
        $data = [
            'page_title' => 'Dashboard',
            'newsCount' => $newsCount,
            'doctorCount' => $doctorCount,
            'pendingComplaintCount' => $pendingComplaintCount,
            'pendingDonationCount' => $pendingDonationCount,
            'totalDonationAmount' => $totalDonationAmount,
            'latestNews' => $latestNews,
            'visitStats' => $visitStats
        ];
        
        $this->view('admin/dashboard', $data, 'admin');
    }
}
