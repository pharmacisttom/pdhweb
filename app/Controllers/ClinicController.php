<?php
namespace App\Controllers;

use App\Core\Controller;

class ClinicController extends Controller {
    
    private $clinicModel;

    public function __construct() {
        $this->clinicModel = $this->model('Clinic');
    }

    public function index() {
        $clinics = $this->clinicModel->getAll();
        
        // Group by department if needed, but for now just pass to view
        $data = [
            'page_title' => 'คลินิกเฉพาะโรคและตารางแพทย์',
            'clinics' => $clinics
        ];
        
        $this->view('clinics/index', $data);
    }
    
    public function show($id) {
        $clinic = $this->clinicModel->getById($id);
        if(!$clinic) {
            $this->redirect('clinics');
        }
        
        $schedules = $this->clinicModel->getSchedules($id);
        
        $data = [
            'page_title' => $clinic->name,
            'clinic' => $clinic,
            'schedules' => $schedules
        ];
        
        $this->view('clinics/show', $data);
    }
}
