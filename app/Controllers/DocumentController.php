<?php
namespace App\Controllers;

use App\Core\Controller;

class DocumentController extends Controller
{
    private $documents;

    public function __construct()
    {
        $this->documents = $this->model('Document');
    }

    public function downloads()
    {
        $this->render('download');
    }

    public function officialOrders()
    {
        $this->render('official_order');
    }

    private function render($category)
    {
        $this->view('documents/index', [
            'page_title' => $category === 'official_order' ? 'หนังสือราชการและคำสั่ง' : 'ดาวน์โหลดเอกสาร',
            'category' => $category,
            'documents' => $this->documents->getPublished($category),
        ]);
    }
}
