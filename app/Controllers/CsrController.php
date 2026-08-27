<?php
namespace App\Controllers;

use App\Core\Controller;

class CsrController extends Controller {
    public function index() {
        $projects = $this->model('CsrProject')->getPublished();
        $this->view('csr/index', [
            'page_title' => 'ความร่วมมือ CSR เพื่อชุมชน',
            'projects' => $projects,
            'og_description' => 'ความร่วมมือ CSR ระหว่างภาคเอกชนและโรงพยาบาลปลวกแดง เพื่อดูแลสุขภาพของชุมชนอย่างยั่งยืน'
        ]);
    }
}
