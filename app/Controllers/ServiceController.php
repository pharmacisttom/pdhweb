<?php
namespace App\Controllers;

use App\Core\Controller;

class ServiceController extends Controller {
    
    private $serviceModel;

    public function __construct() {
        $this->serviceModel = $this->model('Service');
    }

    public function index() {
        $services = $this->serviceModel->getAll();
        
        $data = [
            'page_title' => 'บริการทางการแพทย์',
            'services' => $services
        ];
        
        $this->view('services/index', $data);
    }
}
