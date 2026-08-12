<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class NewsController extends Controller {
    
    private $newsModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->newsModel = $this->model('News');
    }

    public function index() {
        $newsList = $this->newsModel->getAll();
        $data = [
            'page_title' => 'จัดการข่าวสารประชาสัมพันธ์',
            'newsList' => $newsList
        ];
        
        $this->view('admin/news/index', $data, 'admin');
    }

    public function create() {
        $data = [
            'page_title' => 'เพิ่มข่าวสาร'
        ];
        $this->view('admin/news/create', $data, 'admin');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            // Generate slug if empty
            $slug = !empty($_POST['slug']) ? $_POST['slug'] : strtolower(str_replace(' ', '-', trim($_POST['title'])));
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug); // basic sanitization for slug

            $cover_image = 'default-news.jpg';
            if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../public/assets/images/news/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = time() . '_' . basename($_FILES['cover_image']['name']);
                $targetFilePath = $uploadDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp');
                if (in_array(strtolower($fileType), $allowTypes)) {
                    if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetFilePath)) {
                        $cover_image = $fileName;
                    }
                }
            }

            $pdf_file = null;
            if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
                $uploadPdfDir = '../public/assets/docs/news/';
                if (!is_dir($uploadPdfDir)) {
                    mkdir($uploadPdfDir, 0777, true);
                }
                $pdfFileName = time() . '_' . basename($_FILES['pdf_file']['name']);
                $targetPdfPath = $uploadPdfDir . $pdfFileName;
                $pdfFileType = pathinfo($targetPdfPath, PATHINFO_EXTENSION);
                
                if (strtolower($pdfFileType) == 'pdf') {
                    if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $targetPdfPath)) {
                        $pdf_file = $pdfFileName;
                    }
                }
            }

            $data = [
                'title' => trim($_POST['title']),
                'slug' => $slug,
                'summary' => trim($_POST['summary']),
                'content' => $_POST['content'], // usually requires richer sanitization like HTMLPurifier
                'cover_image' => $cover_image,
                'pdf_file' => $pdf_file,
                'category' => trim($_POST['category']),
                'status' => trim($_POST['status'])
            ];

            if ($this->newsModel->create($data)) {
                $this->redirect('admin/news');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function edit($id) {
        $news = $this->newsModel->getById($id);

        $data = [
            'page_title' => 'แก้ไขข่าวสาร',
            'news' => $news
        ];
        $this->view('admin/news/edit', $data, 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);
            
            $slug = !empty($_POST['slug']) ? $_POST['slug'] : strtolower(str_replace(' ', '-', trim($_POST['title'])));
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

            $news = $this->newsModel->getById($id);
            $cover_image = $news->cover_image;
            
            if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../public/assets/images/news/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = time() . '_' . basename($_FILES['cover_image']['name']);
                $targetFilePath = $uploadDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp');
                if (in_array(strtolower($fileType), $allowTypes)) {
                    if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetFilePath)) {
                        $cover_image = $fileName;
                        
                        if ($news->cover_image != 'default-news.jpg' && file_exists($uploadDir . $news->cover_image)) {
                            unlink($uploadDir . $news->cover_image);
                        }
                    }
                }
            }

            $pdf_file = $news->pdf_file;
            if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
                $uploadPdfDir = '../public/assets/docs/news/';
                if (!is_dir($uploadPdfDir)) {
                    mkdir($uploadPdfDir, 0777, true);
                }
                $pdfFileName = time() . '_' . basename($_FILES['pdf_file']['name']);
                $targetPdfPath = $uploadPdfDir . $pdfFileName;
                $pdfFileType = pathinfo($targetPdfPath, PATHINFO_EXTENSION);
                
                if (strtolower($pdfFileType) == 'pdf') {
                    if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $targetPdfPath)) {
                        $pdf_file = $pdfFileName;
                        
                        if (!empty($news->pdf_file) && file_exists($uploadPdfDir . $news->pdf_file)) {
                            unlink($uploadPdfDir . $news->pdf_file);
                        }
                    }
                }
            }

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'slug' => $slug,
                'summary' => trim($_POST['summary']),
                'content' => $_POST['content'],
                'category' => trim($_POST['category']),
                'status' => trim($_POST['status']),
                'cover_image' => $cover_image,
                'pdf_file' => $pdf_file
            ];

            if ($this->newsModel->update($data)) {
                $this->redirect('admin/news');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->newsModel->delete($id)) {
                $this->redirect('admin/news');
            } else {
                die('Something went wrong');
            }
        }
    }
}
