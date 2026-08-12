<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class ServiceController extends Controller {
    
    private $serviceModel;

    public function __construct() {
        AuthMiddleware::check();
        $this->serviceModel = $this->model('Service');
    }

    public function index() {
        $services = $this->serviceModel->getAll();
        $data = [
            'page_title' => 'จัดการบริการ',
            'services' => $services
        ];
        
        $this->view('admin/services/index', $data, 'admin');
    }
}
