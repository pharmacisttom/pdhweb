<?php
namespace App\Controllers;

use App\Core\Controller;

class DoctorController extends Controller {
    
    private $doctorModel;

    public function __construct() {
        $this->doctorModel = $this->model('Doctor');
    }

    public function index() {
        $doctors = $this->doctorModel->getAll();
        
        $data = [
            'page_title' => 'ทำเนียบแพทย์',
            'doctors' => $doctors
        ];
        
        $this->view('doctors/index', $data);
    }
}
