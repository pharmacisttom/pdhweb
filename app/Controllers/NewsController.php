<?php
namespace App\Controllers;

use App\Core\Controller;

class NewsController extends Controller {
    
    private $newsModel;

    public function __construct() {
        $this->newsModel = $this->model('News');
    }

    public function index() {
        $newsList = $this->newsModel->getPublished();
        
        $data = [
            'page_title' => 'ข่าวสารและกิจกรรม',
            'newsList' => $newsList
        ];
        
        $this->view('news/index', $data);
    }
    
    public function show($slug) {
        $news = $this->newsModel->getBySlug($slug);
        
        if(!$news) {
            $this->redirect('news');
        }
        
        $data = [
            'page_title' => $news->title,
            'news' => $news
        ];
        
        $this->view('news/show', $data);
    }
}
