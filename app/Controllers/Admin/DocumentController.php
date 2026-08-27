<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Helpers\Security;
use App\Middleware\AuthMiddleware;

class DocumentController extends Controller
{
    private const CATEGORIES = ['download', 'official_order'];
    private $documents;

    public function __construct()
    {
        AuthMiddleware::check();
        $this->documents = $this->model('Document');
    }

    public function index()
    {
        $category = $_GET['category'] ?? null;
        if (!in_array($category, self::CATEGORIES, true)) $category = null;
        $this->view('admin/documents/index', ['page_title' => 'จัดการเอกสาร PDF', 'documents' => $this->documents->getAll($category), 'category' => $category], 'admin');
    }

    public function create()
    {
        $this->view('admin/documents/form', ['page_title' => 'อัปโหลดเอกสาร PDF', 'document' => null], 'admin');
    }

    public function store()
    {
        if (!$this->isPost()) return;
        Security::validateCsrf();
        $data = $this->validatedData();
        if ($data === null) return;
        $upload = $this->storePdf();
        if ($upload === null) return;
        $data = array_merge($data, $upload);
        if ($this->documents->create($data)) {
            $this->setFlash('document_success', 'อัปโหลดเอกสารเรียบร้อยแล้ว');
            $this->redirect('admin/documents');
        }
        $this->setFlash('document_error', 'ไม่สามารถบันทึกเอกสารได้', 'danger');
        $this->redirect('admin/documents/create');
    }

    public function edit($id)
    {
        $document = $this->documents->getById($id);
        if (!$document) {
            $this->redirect('admin/documents');
            return;
        }
        $this->view('admin/documents/form', ['page_title' => 'แก้ไขเอกสาร PDF', 'document' => $document], 'admin');
    }

    public function update($id)
    {
        if (!$this->isPost()) return;
        Security::validateCsrf();
        $document = $this->documents->getById($id);
        if (!$document) {
            $this->redirect('admin/documents');
            return;
        }
        $data = $this->validatedData();
        if ($data === null) return;
        $upload = $this->storePdf($document);
        if ($upload === null) return;
        $data = array_merge($data, $upload, ['id' => (int)$id]);
        if ($this->documents->update($data)) {
            $this->setFlash('document_success', 'บันทึกเอกสารเรียบร้อยแล้ว');
            $this->redirect('admin/documents');
        }
        $this->setFlash('document_error', 'ไม่สามารถบันทึกเอกสารได้', 'danger');
        $this->redirect('admin/documents/edit/' . (int)$id);
    }

    public function delete($id)
    {
        if (!$this->isPost()) return;
        Security::validateCsrf();
        $document = $this->documents->getById($id);
        if ($document && $this->documents->delete($id)) {
            $this->deleteFile($document->file_name);
            $this->setFlash('document_success', 'ลบเอกสารเรียบร้อยแล้ว');
        }
        $this->redirect('admin/documents');
    }

    private function validatedData()
    {
        $title = trim($_POST['title'] ?? '');
        $category = $_POST['category'] ?? 'download';
        if ($title === '' || !in_array($category, self::CATEGORIES, true)) {
            $this->setFlash('document_error', 'กรุณาระบุชื่อเอกสารและหมวดหมู่ให้ถูกต้อง', 'warning');
            $this->redirect('admin/documents/create');
            return null;
        }
        return [
            'title' => $title,
            'description' => trim($_POST['description'] ?? ''),
            'document_number' => trim($_POST['document_number'] ?? ''),
            'category' => $category,
            'issued_date' => Security::isValidDate($_POST['issued_date'] ?? '') ? $_POST['issued_date'] : null,
            'status' => in_array($_POST['status'] ?? '', ['draft', 'published'], true) ? $_POST['status'] : 'draft',
        ];
    }

    private function storePdf($current = null)
    {
        if (!isset($_FILES['pdf_file']) || $_FILES['pdf_file']['error'] === UPLOAD_ERR_NO_FILE) {
            if ($current) return ['file_name' => $current->file_name, 'original_name' => $current->original_name, 'file_size' => $current->file_size];
            $this->setFlash('document_error', 'กรุณาเลือกไฟล์ PDF', 'warning');
            $this->redirect('admin/documents/create');
            return null;
        }
        $file = $_FILES['pdf_file'];
        if ($file['error'] !== UPLOAD_ERR_OK || $file['size'] > 20 * 1024 * 1024 || (new \finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']) !== 'application/pdf') {
            $this->setFlash('document_error', 'ไฟล์ต้องเป็น PDF และมีขนาดไม่เกิน 20 MB', 'warning');
            $this->redirect($current ? 'admin/documents/edit/' . $current->id : 'admin/documents/create');
            return null;
        }
        $directory = APPROOT . '/public/assets/docs/documents/';
        if ((!is_dir($directory) && !mkdir($directory, 0775, true)) || !is_writable($directory)) {
            $this->setFlash('document_error', 'โฟลเดอร์เอกสารไม่มีสิทธิ์เขียนไฟล์ กรุณาตรวจสอบเซิร์ฟเวอร์', 'danger');
            $this->redirect($current ? 'admin/documents/edit/' . $current->id : 'admin/documents/create');
            return null;
        }
        $filename = bin2hex(random_bytes(16)) . '.pdf';
        if (!move_uploaded_file($file['tmp_name'], $directory . $filename)) {
            $this->setFlash('document_error', 'อัปโหลดไฟล์ไม่สำเร็จ', 'danger');
            $this->redirect($current ? 'admin/documents/edit/' . $current->id : 'admin/documents/create');
            return null;
        }
        if ($current) $this->deleteFile($current->file_name);
        return ['file_name' => $filename, 'original_name' => basename($file['name']), 'file_size' => (int)$file['size']];
    }

    private function deleteFile($filename)
    {
        if ($filename && basename($filename) === $filename) {
            $path = APPROOT . '/public/assets/docs/documents/' . $filename;
            if (is_file($path)) unlink($path);
        }
    }
}
