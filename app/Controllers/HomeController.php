<?php
namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller {
    
    private $newsModel;
    private $bannerModel;

    public function __construct() {
        $this->newsModel = $this->model('News');
        $this->bannerModel = $this->model('Banner');
    }

    public function index() {
        $db = new \App\Core\Database();
        $db->query("SELECT setting_value FROM settings WHERE setting_key = 'news_categories'");
        $row = $db->single();
        $categories = $row ? json_decode($row->setting_value, true) : [];
        
        // Fetch up to 5 latest published news per category
        $newsByCategory = [];
        foreach ($categories as $cat) {
            $newsByCategory[$cat['slug']] = [
                'name' => $cat['name'],
                'items' => $this->newsModel->getPublishedByCategory($cat['slug'], 5)
            ];
        }
        
        // Fetch slider settings
        $db->query("SELECT setting_key, setting_value FROM settings WHERE setting_key IN ('banner_slider_interval', 'banner_transition_effect', 'queue_enabled')");
        $sliderRows = $db->resultSet();
        $sliderSettings = [];
        foreach ($sliderRows as $sr) {
            $sliderSettings[$sr->setting_key] = $sr->setting_value;
        }

        // Fetch active banners
        $banners = $this->bannerModel->getActive();

        // Fetch active donation campaigns
        $donationItemModel = $this->model('DonationItem');
        $donationItems = $donationItemModel->getActive();
        $totalDonationRaised = 0;
        $totalDonationTarget = 0;
        if (!empty($donationItems)) {
            foreach ($donationItems as $it) {
                $totalDonationRaised += floatval($it->current_amount ?? 0);
                $totalDonationTarget += floatval($it->target_amount ?? 0);
            }
        }

        $data = [
            'page_title' => 'หน้าแรก',
            'newsByCategory' => $newsByCategory,
            'banners' => $banners,
            'donationItems' => array_slice($donationItems, 0, 4),
            'totalDonationRaised' => $totalDonationRaised,
            'totalDonationTarget' => $totalDonationTarget,
            'slider_interval' => $sliderSettings['banner_slider_interval'] ?? '5000',
            'slider_transition' => $sliderSettings['banner_transition_effect'] ?? 'fade',
            'queueEnabled' => ($sliderSettings['queue_enabled'] ?? '0') === '1'
        ];
        
        $this->view('home/index', $data);
    }
}
