<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Helpers\Security;

class PageController extends Controller {
    
    private $pageModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->pageModel = $this->model('Page');
    }

    public function index() {
        $pages = $this->pageModel->getAll();
        $data = [
            'page_title' => 'จัดการหน้าเพจองค์กร',
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
            Security::validateCsrf();
            
            $title = trim($_POST['title'] ?? '');
            $rawSlug = !empty($_POST['slug']) ? $_POST['slug'] : strtolower(str_replace(' ', '-', $title));
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $rawSlug);

            $data = [
                'title' => $title,
                'slug' => $slug,
                'content' => $_POST['content'] ?? '',
                'status' => trim($_POST['status'] ?? 'draft')
            ];

            if ($this->pageModel->create($data)) {
                $this->redirect('admin/page');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function edit($id) {
        $page = $this->pageModel->getById($id);

        if (!$page) {
            $this->redirect('admin/page');
            return;
        }

        $data = [
            'page_title' => 'แก้ไขหน้าเพจองค์กร',
            'page' => $page
        ];
        $this->view('admin/pages/edit', $data, 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Security::validateCsrf();
            
            $title = trim($_POST['title'] ?? '');
            $rawSlug = !empty($_POST['slug']) ? $_POST['slug'] : strtolower(str_replace(' ', '-', $title));
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $rawSlug);

            $data = [
                'id' => $id,
                'title' => $title,
                'slug' => $slug,
                'content' => $_POST['content'] ?? '',
                'status' => trim($_POST['status'] ?? 'draft')
            ];

            if ($this->pageModel->update($data)) {
                $this->redirect('admin/page');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Security::validateCsrf();
            if ($this->pageModel->delete($id)) {
                $this->redirect('admin/page');
            } else {
                die('Something went wrong');
            }
        }
    }
}
