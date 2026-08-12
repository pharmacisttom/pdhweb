<?php
namespace App\Controllers;

use App\Core\Controller;

class DepartmentController extends Controller {
    
    private $departmentModel;

    public function __construct() {
        $this->departmentModel = $this->model('Department');
    }

    public function index() {
        $departments = $this->departmentModel->getAll();
        
        $data = [
            'page_title' => 'กลุ่มงาน/ฝ่าย',
            'departments' => $departments
        ];
        
        $this->view('departments/index', $data);
    }
}
