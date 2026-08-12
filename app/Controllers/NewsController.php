<?php
namespace App\Controllers;

use App\Core\Controller;

class NewsController extends Controller {
    
    private $newsModel;

    public function __construct() {
        $this->newsModel = $this->model('News');
    }

    public function index() {
        $categorySlug = isset($_GET['category']) ? $_GET['category'] : null;
        
        if ($categorySlug) {
            $newsList = $this->newsModel->getPublishedByCategory($categorySlug, null);
        } else {
            $newsList = $this->newsModel->getPublished();
        }
        
        $db = new \App\Core\Database();
        $db->query("SELECT setting_value FROM settings WHERE setting_key = 'news_categories'");
        $row = $db->single();
        $categories = $row ? json_decode($row->setting_value, true) : [];
        
        $data = [
            'page_title' => 'ข่าวสารและกิจกรรม',
            'newsList' => $newsList,
            'categories' => $categories,
            'current_category' => $categorySlug
        ];
        
        $this->view('news/index', $data);
    }
    
    public function show($slug = null) {
        if (!$slug) {
            $this->redirect('news');
        }
        
        $news = $this->newsModel->getBySlug($slug);
        
        if(!$news) {
            $this->redirect('news');
        }
        
        $db = new \App\Core\Database();
        $db->query("SELECT setting_value FROM settings WHERE setting_key = 'news_categories'");
        $row = $db->single();
        $categories = $row ? json_decode($row->setting_value, true) : [];
        
        $data = [
            'page_title' => $news->title,
            'og_type' => 'article',
            'og_description' => strip_tags($news->summary),
            'og_image' => URLROOT . '/assets/images/news/' . $news->cover_image,
            'news' => $news,
            'categories' => $categories
        ];
        
        $this->view('news/show', $data);
    }
}
