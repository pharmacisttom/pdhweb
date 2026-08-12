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
            'page_title' => 'ตั้งค่าระบบ',
            'settings' => $settings,
            'news_categories' => $newsCategories
        ];

        $this->view('admin/settings/index', $data, 'admin');
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

            $this->redirect('admin/settings');
        }
    }
}
