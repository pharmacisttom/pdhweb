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

    public function schedule() {
        $schedules = $this->doctorModel->getAllSchedules();
        $doctors = $this->doctorModel->getAll();
        $clinicModel = $this->model('Clinic');
        $clinics = $clinicModel->getAll();

        // Current Thai Day of week (1=Monday ... 7=Sunday)
        $nDay = (int)date('N'); // 1 (for Monday) through 7 (for Sunday)

        // Group schedules by day_of_week
        $schedulesByDay = [1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => []];
        $schedulesByDoctor = [];
        $schedulesByClinic = [];

        foreach ($schedules as $sch) {
            $day = (int)$sch->day_of_week;
            $schedulesByDay[$day][] = $sch;

            $docId = $sch->doctor_id;
            if (!isset($schedulesByDoctor[$docId])) {
                $schedulesByDoctor[$docId] = [
                    'doctor' => $sch,
                    'slots' => []
                ];
            }
            $schedulesByDoctor[$docId]['slots'][] = $sch;

            $cId = $sch->clinic_id;
            if (!isset($schedulesByClinic[$cId])) {
                $schedulesByClinic[$cId] = [
                    'clinic_name' => $sch->clinic_name,
                    'clinic_location' => $sch->clinic_location,
                    'slots' => []
                ];
            }
            $schedulesByClinic[$cId]['slots'][] = $sch;
        }

        $data = [
            'page_title' => 'ตารางออกตรวจแพทย์',
            'schedules' => $schedules,
            'schedulesByDay' => $schedulesByDay,
            'schedulesByDoctor' => $schedulesByDoctor,
            'schedulesByClinic' => $schedulesByClinic,
            'doctors' => $doctors,
            'clinics' => $clinics,
            'currentDay' => $nDay,
            'og_description' => 'ตารางเวลาออกตรวจแพทย์และคลินิกเฉพาะทาง โรงพยาบาลปลวกแดง ตรวจสอบวันและเวลาทำการ'
        ];

        $this->view('doctors/schedule', $data);
    }
}
