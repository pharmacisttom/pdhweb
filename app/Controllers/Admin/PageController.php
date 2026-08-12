<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class PageController extends Controller {
    
    private $pageModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->pageModel = $this->model('Page');
    }

    public function index() {
        $pages = $this->pageModel->getAll();
        $data = [
            'page_title' => 'จัดการหน้าเพจ',
            'pages' => $pages
        ];
        
        $this->view('admin/pages/index', $data, 'admin');
    }

    public function create() {
        $data = [
            'page_title' => 'สร้างหน้าเพจใหม่'
        ];
        $this->view('admin/pages/create', $data, 'admin');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            $slug = !empty($_POST['slug']) ? $_POST['slug'] : strtolower(str_replace(' ', '-', trim($_POST['title'])));
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

            $data = [
                'title' => trim($_POST['title']),
                'slug' => $slug,
                'content' => $_POST['content'],
                'status' => trim($_POST['status'])
            ];

            if ($this->pageModel->create($data)) {
                $this->redirect('admin/pages');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function edit($id) {
        $page = $this->pageModel->getById($id);

        $data = [
            'page_title' => 'แก้ไขหน้าเพจ',
            'page' => $page
        ];
        $this->view('admin/pages/edit', $data, 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            $slug = !empty($_POST['slug']) ? $_POST['slug'] : strtolower(str_replace(' ', '-', trim($_POST['title'])));
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'slug' => $slug,
                'content' => $_POST['content'],
                'status' => trim($_POST['status'])
            ];

            if ($this->pageModel->update($data)) {
                $this->redirect('admin/pages');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->pageModel->delete($id)) {
                $this->redirect('admin/pages');
            } else {
                die('Something went wrong');
            }
        }
    }
}
