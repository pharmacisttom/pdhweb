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
        }
        
        $page = $this->pageModel->getBySlug($slug);
        
        if(!$page) {
            // Return 404 conceptually
            die('Page not found');
        }
        
        $data = [
            'page_title' => $page->title,
            'page' => $page
        ];
        
        $this->view('pages/show', $data);
    }
}
