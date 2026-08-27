<?php
namespace App\Controllers\Admin;

use App\Core\Controller;

class SettingsController extends Controller {
    private $db;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
        }
        $this->db = new \App\Core\Database();
    }

    public function index() {
        $this->db->query("SELECT * FROM settings");
        $settingsRaw = $this->db->resultSet();
        $settings = [];
        foreach ($settingsRaw as $row) {
            $settings[$row->setting_key] = $row->setting_value;
        }

        $newsCategories = [];
        if (isset($settings['news_categories'])) {
            $newsCategories = json_decode($settings['news_categories'], true);
        }

        $data = [
            'page_title' => 'ตั้งค่าระบบและการเชื่อมต่อ (Settings & API)',
            'settings' => $settings,
            'news_categories' => $newsCategories
        ];

        $this->view('admin/settings/index', $data, 'admin');
    }

    // Update Social & API Connections (FB, LINE OA, LINE Notify)
    public function updateSocial() {
        if ($this->isPost()) {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);

            $fields = [
                'facebook_page_url',
                'facebook_page_id',
                'facebook_messenger_url',
                'line_oa_id',
                'line_add_friend_url',
                'line_qr_code_url',
                'line_channel_access_token',
                'line_channel_secret',
                'line_notify_token'
            ];

            foreach ($fields as $field) {
                if (isset($_POST[$field])) {
                    $val = trim($_POST[$field]);
                    if (in_array($field, ['line_channel_access_token', 'line_channel_secret', 'line_notify_token'], true) && $val === '') {
                        continue;
                    }
                    $this->db->query("INSERT INTO settings (setting_key, setting_value) VALUES (:k, :v) ON DUPLICATE KEY UPDATE setting_value = :v2");
                    $this->db->bind(':k', $field);
                    $this->db->bind(':v', $val);
                    $this->db->bind(':v2', $val);
                    $this->db->execute();
                }
            }

            $this->setFlash('settings_success', 'บันทึกการตั้งค่า Facebook & LINE OA เรียบร้อยแล้ว');
            $this->redirect('admin/settings');
        }
    }

    // Update Hospital Info
    public function updateHospital() {
        if ($this->isPost()) {
            \App\Helpers\Security::validateCsrf();
            $_POST = \App\Helpers\Security::xssClean($_POST);

            $fields = [
                'hospital_name_th',
                'hospital_name_en',
                'telephone',
                'emergency_phone',
                'email',
                'address',
                'google_maps_embed'
            ];

            foreach ($fields as $field) {
                if (isset($_POST[$field])) {
                    $val = trim($_POST[$field]);
                    $this->db->query("INSERT INTO settings (setting_key, setting_value) VALUES (:k, :v) ON DUPLICATE KEY UPDATE setting_value = :v2");
                    $this->db->bind(':k', $field);
                    $this->db->bind(':v', $val);
                    $this->db->bind(':v2', $val);
                    $this->db->execute();
                }
            }

            $this->setFlash('settings_success', 'บันทึกข้อมูลโรงพยาบาลเรียบร้อยแล้ว');
            $this->redirect('admin/settings');
        }
    }

    // Test LINE Notify Token
    public function testLineNotify() {
        if ($this->isPost()) {
            \App\Helpers\Security::validateCsrf();
            $token = trim($_POST['token'] ?? '');

            if (empty($token)) {
                $this->setFlash('settings_warning', 'โปรดระบุ LINE Notify Token ก่อนทดสอบ', 'warning');
                $this->redirect('admin/settings');
                return;
            }

            $message = "\n🔔 ทดสอบการเชื่อมต่อระบบแจ้งเตือน\nโรงพยาบาลปลวกแดง\nเวลา: " . date('d/m/Y H:i:s');
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://notify-api.line.me/api/notify');
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'message=' . urlencode($message));
            $headers = [
                'Content-type: application/x-www-form-urlencoded',
                'Authorization: Bearer ' . $token,
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200) {
                $this->setFlash('settings_success', 'ส่งข้อความทดสอบเข้า LINE Notify สำเร็จแล้ว!');
            } else {
                $this->setFlash('settings_warning', 'การส่งข้อความล้มเหลว ตรวจสอบ Token ของท่าน (HTTP ' . $httpCode . ')', 'warning');
            }

            $this->redirect('admin/settings');
        }
    }

    public function updateCategories() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \App\Helpers\Security::validateCsrf();

            $slugs = $_POST['category_slug'] ?? [];
            $names = $_POST['category_name'] ?? [];

            $categories = [];
            for ($i = 0; $i < count($slugs); $i++) {
                if (!empty(trim($slugs[$i])) && !empty(trim($names[$i]))) {
                    $categories[] = [
                        'slug' => preg_replace('/[^A-Za-z0-9\-\p{Thai}]/u', '', strtolower(str_replace(' ', '-', trim($slugs[$i])))),
                        'name' => trim($names[$i])
                    ];
                }
            }

            $categoriesJson = json_encode($categories, JSON_UNESCAPED_UNICODE);

            $this->db->query("INSERT INTO settings (setting_key, setting_value) VALUES ('news_categories', :val) ON DUPLICATE KEY UPDATE setting_value = :val");
            $this->db->bind(':val', $categoriesJson);
            $this->db->execute();

            $this->setFlash('settings_success', 'บันทึกหมวดหมู่ข่าวสารเรียบร้อยแล้ว');
            $this->redirect('admin/settings');
        }
    }

    public function updateFeatures() {
        if (!$this->isPost()) {
            return;
        }

        \App\Helpers\Security::validateCsrf();
        $enabled = isset($_POST['queue_enabled']) ? '1' : '0';
        $this->db->query("INSERT INTO settings (setting_key, setting_value) VALUES ('queue_enabled', :value) ON DUPLICATE KEY UPDATE setting_value = :value");
        $this->db->bind(':value', $enabled);
        $this->db->execute();
        $this->setFlash('settings_success', 'บันทึกการเปิดใช้งานระบบคิวแล้ว');
        $this->redirect('admin/settings');
    }
}
