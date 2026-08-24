<?php
namespace App\Controllers;

use App\Core\Controller;

class ContactController extends Controller {
    
    public function index() {
        $data = [
            'page_title' => 'ติดต่อเรา',
            'og_description' => 'ข้อมูลการติดต่อ หมายเลขโทรศัพท์ และเบอร์ต่อภายใน โรงพยาบาลปลวกแดง จ.ระยอง'
        ];
        
        $this->view('contact/index', $data);
    }
}
