<?php
namespace App\Controllers;

use App\Core\Controller;

class RiskController extends Controller {
    
    public function index() {
        $data = [
            'page_title' => 'ระบบสารสนเทศการบริหารจัดการความเสี่ยง (HRMS / Thai-NRLS)',
            'og_description' => 'ระบบสารสนเทศการบริหารจัดการความเสี่ยงของสถานพยาบาล (Healthcare Risk Management System - HRMS) โรงพยาบาลปลวกแดง https://pdh.thai-nrls.org/',
            'nrls_url' => 'https://pdh.thai-nrls.org/'
        ];
        
        $this->view('risk/index', $data);
    }
}
