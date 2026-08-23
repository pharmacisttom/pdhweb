<?php
namespace App\Controllers;

use App\Core\Controller;

class ApiController extends Controller {

    public function index() {
        return $this->json([
            'status' => 'success',
            'message' => 'PDH Web REST API v1.0',
            'timestamp' => date('c'),
            'endpoints' => [
                'GET /api/social' => 'Get Facebook & LINE OA official links and tokens',
                'GET /api/doctors' => 'Search and list medical doctors',
                'GET /api/clinics' => 'Get clinics and schedules',
                'GET /api/queue' => 'Get live queue status',
                'GET /api/news' => 'Get news by category',
                'GET /api/stats' => 'Get hospital overview statistics'
            ]
        ]);
    }

    // GET /api/social
    public function social() {
        $db = new \App\Core\Database();
        $db->query("SELECT setting_key, setting_value FROM settings WHERE setting_key IN ('facebook_page_url', 'facebook_page_id', 'facebook_messenger_url', 'line_oa_id', 'line_add_friend_url', 'line_qr_code_url', 'telephone', 'emergency_phone', 'hospital_name_th', 'hospital_name_en')");
        $rows = $db->resultSet();
        $social = [];
        foreach ($rows as $r) {
            $social[$r->setting_key] = $r->setting_value;
        }

        return $this->json([
            'status' => 'success',
            'facebook' => [
                'page_url' => $social['facebook_page_url'] ?? 'https://www.facebook.com/pluakdaenghospital',
                'page_id' => $social['facebook_page_id'] ?? 'pluakdaenghospital',
                'messenger_url' => $social['facebook_messenger_url'] ?? 'https://m.me/pluakdaenghospital'
            ],
            'line_oa' => [
                'oa_id' => $social['line_oa_id'] ?? '@pluakdaenghos',
                'add_friend_url' => $social['line_add_friend_url'] ?? 'https://page.line.me/pluakdaenghos',
                'qr_code_url' => $social['line_qr_code_url'] ?? ''
            ],
            'contact' => [
                'telephone' => $social['telephone'] ?? '038-659-188',
                'emergency_phone' => $social['emergency_phone'] ?? '1669',
                'hospital_name' => $social['hospital_name_th'] ?? 'โรงพยาบาลปลวกแดง'
            ]
        ]);
    }

    // GET /api/doctors
    public function doctors() {
        $doctorModel = $this->model('Doctor');
        $doctors = $doctorModel->getAll();
        
        $search = trim($_GET['search'] ?? '');
        $specialty = trim($_GET['specialty'] ?? '');

        if ($search !== '' || $specialty !== '') {
            $doctors = array_values(array_filter($doctors, function($doc) use ($search, $specialty) {
                $nameMatch = empty($search) || 
                    (mb_stripos($doc->firstname, $search) !== false) || 
                    (mb_stripos($doc->lastname, $search) !== false) || 
                    (mb_stripos($doc->specialty ?? '', $search) !== false) ||
                    (mb_stripos($doc->position ?? '', $search) !== false);

                $specMatch = empty($specialty) || 
                    (mb_stripos($doc->specialty ?? '', $specialty) !== false);

                return $nameMatch && $specMatch;
            }));
        }

        return $this->json([
            'status' => 'success',
            'count' => count($doctors),
            'data' => $doctors
        ]);
    }

    // GET /api/clinics
    public function clinics() {
        $clinicModel = $this->model('Clinic');
        $clinics = $clinicModel->getAll();

        return $this->json([
            'status' => 'success',
            'count' => count($clinics),
            'data' => $clinics
        ]);
    }

    // GET /api/queue
    public function queue() {
        $queueModel = $this->model('Queue');
        $departmentModel = $this->model('Department');
        
        $departments = $departmentModel->getAll();
        $queues = $queueModel->getTodayQueues();

        $stats = [
            'total_today' => count($queues),
            'waiting' => count(array_filter($queues, fn($q) => $q->status === 'waiting')),
            'calling' => count(array_filter($queues, fn($q) => $q->status === 'calling')),
            'completed' => count(array_filter($queues, fn($q) => $q->status === 'completed')),
        ];

        return $this->json([
            'status' => 'success',
            'stats' => $stats,
            'departments' => $departments,
            'queues' => $queues
        ]);
    }

    // GET /api/news
    public function news() {
        $newsModel = $this->model('News');
        $category = $_GET['category'] ?? null;

        if ($category) {
            $news = $newsModel->getByCategory($category, 12);
        } else {
            $news = $newsModel->getLatest(12);
        }

        return $this->json([
            'status' => 'success',
            'count' => count($news),
            'data' => $news
        ]);
    }

    // GET /api/stats
    public function stats() {
        $doctorModel = $this->model('Doctor');
        $clinicModel = $this->model('Clinic');
        $newsModel = $this->model('News');
        $donationItemModel = $this->model('DonationItem');

        $doctors = $doctorModel->getAll();
        $clinics = $clinicModel->getAll();
        $news = $newsModel->getAll();
        $donations = $donationItemModel->getAll();

        return $this->json([
            'status' => 'success',
            'data' => [
                'doctors_count' => count($doctors),
                'clinics_count' => count($clinics),
                'news_count' => count($news),
                'donation_items_count' => count($donations),
                'server_time' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
