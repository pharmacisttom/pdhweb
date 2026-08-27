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

        $data = [
            'page_title' => 'หน้าแรก',
            'newsByCategory' => $newsByCategory,
            'banners' => $banners,
            'slider_interval' => $sliderSettings['banner_slider_interval'] ?? '5000',
            'slider_transition' => $sliderSettings['banner_transition_effect'] ?? 'fade',
            'queueEnabled' => ($sliderSettings['queue_enabled'] ?? '0') === '1'
        ];
        
        $this->view('home/index', $data);
    }
}
