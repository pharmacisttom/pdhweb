<?php
namespace App\Controllers;

use App\Core\Controller;

class ItaController extends Controller {
    
    public function index() {
        $data = [
            'page_title' => 'การประเมินคุณธรรมและความโปร่งใส (ITA / MOIT)',
            'og_description' => 'ข้อมูลการประเมินคุณธรรมและความโปร่งใสในการดำเนินงานของหน่วยงานภาครัฐ (ITA / MOIT) โรงพยาบาลปลวกแดง'
        ];
        
        $this->view('ita/index', $data);
    }
}
