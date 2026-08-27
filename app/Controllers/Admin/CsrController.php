<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Helpers\Security;
use App\Middleware\AuthMiddleware;

class CsrController extends Controller {
    private $projectModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->projectModel = $this->model('CsrProject');
    }

    public function index() {
        $this->view('admin/csr/index', [
            'page_title' => 'โครงการ CSR และภาคีเครือข่าย',
            'projects' => $this->projectModel->getAll()
        ], 'admin');
    }

    public function create() {
        $this->view('admin/csr/form', ['page_title' => 'เพิ่มโครงการ CSR', 'project' => null], 'admin');
    }

    public function store() {
        if (!$this->isPost()) return;
        Security::validateCsrf();
        $data = $this->validatedData();
        $data['image'] = $this->storeImage();
        if ($this->projectModel->create($data)) {
            $this->setFlash('csr_success', 'เพิ่มโครงการ CSR เรียบร้อยแล้ว');
            $this->redirect('admin/csr');
        }
        $this->setFlash('csr_error', 'ไม่สามารถบันทึกโครงการ CSR ได้', 'warning');
        $this->redirect('admin/csr/create');
    }

    public function edit($id) {
        $project = $this->projectModel->getById($id);
        if (!$project) {
            $this->redirect('admin/csr');
            return;
        }
        $this->view('admin/csr/form', ['page_title' => 'แก้ไขโครงการ CSR', 'project' => $project], 'admin');
    }

    public function update($id) {
        if (!$this->isPost()) return;
        Security::validateCsrf();
        $project = $this->projectModel->getById($id);
        if (!$project) {
            $this->redirect('admin/csr');
            return;
        }

        $data = $this->validatedData();
        $data['id'] = (int)$id;
        $data['image'] = $this->storeImage($project->image);
        if ($this->projectModel->update($data)) {
            $this->setFlash('csr_success', 'บันทึกโครงการ CSR เรียบร้อยแล้ว');
        }
        $this->redirect('admin/csr');
    }

    public function delete($id) {
        if (!$this->isPost()) return;
        Security::validateCsrf();
        $project = $this->projectModel->getById($id);
        if ($project && $this->projectModel->delete($id)) {
            $this->deleteImage($project->image);
            $this->setFlash('csr_success', 'ลบโครงการ CSR เรียบร้อยแล้ว');
        }
        $this->redirect('admin/csr');
    }

    private function validatedData() {
        $companyName = trim($_POST['company_name'] ?? '');
        $projectTitle = trim($_POST['project_title'] ?? '');
        $summary = trim($_POST['summary'] ?? '');
        $website = trim($_POST['website'] ?? '');
        if ($companyName === '' || $projectTitle === '' || $summary === '') {
            http_response_code(422);
            exit('Company, project title, and summary are required.');
        }
        if ($website !== '' && !filter_var($website, FILTER_VALIDATE_URL)) {
            http_response_code(422);
            exit('Invalid website URL.');
        }

        return [
            'company_name' => $companyName,
            'project_title' => $projectTitle,
            'summary' => $summary,
            'contribution' => trim($_POST['contribution'] ?? ''),
            'project_date' => preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['project_date'] ?? '') ? $_POST['project_date'] : null,
            'website' => $website,
            'is_published' => isset($_POST['is_published']) ? 1 : 0,
            'sort_order' => max(0, (int)($_POST['sort_order'] ?? 0))
        ];
    }

    private function storeImage($currentImage = null) {
        if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) return $currentImage;
        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK || $_FILES['image']['size'] > 3 * 1024 * 1024) return $currentImage;

        $mime = (new \finfo(FILEINFO_MIME_TYPE))->file($_FILES['image']['tmp_name']);
        $extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        if (!isset($extensions[$mime])) return $currentImage;

        $directory = APPROOT . '/public/assets/images/csr/';
        if (!is_dir($directory) && !mkdir($directory, 0755, true)) return $currentImage;
        $filename = bin2hex(random_bytes(16)) . '.' . $extensions[$mime];
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $directory . $filename)) return $currentImage;
        $this->deleteImage($currentImage);
        return $filename;
    }

    private function deleteImage($image) {
        if (!$image || basename($image) !== $image) return;
        $path = APPROOT . '/public/assets/images/csr/' . $image;
        if (is_file($path)) unlink($path);
    }
}
