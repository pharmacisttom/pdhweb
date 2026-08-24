<?php
namespace App\Controllers;

use App\Core\Controller;

class PageController extends Controller {
    
    private $pageModel;

    public function __construct() {
        $this->pageModel = $this->model('Page');
    }

    public function show($slug = '') {
        if(empty($slug)) {
            $this->redirect('');
            return;
        }
        
        $page = $this->pageModel->getBySlug($slug);
        
        if(!$page) {
            $data = [
                'page_title' => 'ไม่พบหน้าที่ต้องการ',
                'slug' => $slug
            ];
            $this->view('pages/404', $data);
            return;
        }
        
        $data = [
            'page_title' => $page->title,
            'page' => $page
        ];
        
        $this->view('pages/show', $data);
    }

    public function about() {
        $this->show('about');
    }

    public function executives() {
        $this->show('executives');
    }

    public function vision() {
        $this->show('vision');
    }

    public function rights() {
        $this->show('patient-rights');
    }
}
