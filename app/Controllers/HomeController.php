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
        // Fetch top 3 latest published news
        $latestNews = $this->newsModel->getPublished(3);
        
        // Fetch active banners
        $banners = $this->bannerModel->getActive();

        $data = [
            'page_title' => 'หน้าแรก',
            'latestNews' => $latestNews,
            'banners' => $banners
        ];
        
        $this->view('home/index', $data);
    }
}
