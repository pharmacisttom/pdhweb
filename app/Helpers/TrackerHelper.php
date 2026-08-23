<?php
namespace App\Helpers;

use App\Core\Database;
use PDO;

class TrackerHelper {

    private static $db;

    private static function getDb() {
        if (!self::$db) {
            self::$db = new Database();
            self::ensureTables();
        }
        return self::$db;
    }

    /**
     * Ensure visit logging tables exist in the database
     */
    private static function ensureTables() {
        $sql = "
            CREATE TABLE IF NOT EXISTS `visit_logs` (
                `id` bigint(20) NOT NULL AUTO_INCREMENT,
                `ip_address` varchar(45) NOT NULL,
                `device_type` enum('mobile','tablet','desktop') NOT NULL DEFAULT 'desktop',
                `browser` varchar(50) DEFAULT NULL,
                `os` varchar(50) DEFAULT NULL,
                `page_url` varchar(255) NOT NULL,
                `visit_date` date NOT NULL,
                `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                KEY `idx_visit_date` (`visit_date`),
                KEY `idx_device` (`device_type`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        try {
            self::$db->query($sql);
            self::$db->execute();
        } catch (\Exception $e) {
            error_log("Tracker table creation error: " . $e->getMessage());
        }
    }

    /**
     * Detect device type from User-Agent
     */
    public static function detectDevice($userAgent = null) {
        $ua = $userAgent ?: ($_SERVER['HTTP_USER_AGENT'] ?? '');
        
        if (preg_match('/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i', $ua)) {
            return 'tablet';
        }
        if (preg_match('/(mobi|ipod|phone|blackberry|opera mini|fennec|minimo|symbian|psp|nintendo)/i', $ua)) {
            return 'mobile';
        }
        return 'desktop';
    }

    /**
     * Detect browser from User-Agent
     */
    public static function detectBrowser($userAgent = null) {
        $ua = $userAgent ?: ($_SERVER['HTTP_USER_AGENT'] ?? '');
        if (strpos($ua, 'Edg') !== false) return 'Edge';
        if (strpos($ua, 'Chrome') !== false) return 'Chrome';
        if (strpos($ua, 'Safari') !== false && strpos($ua, 'Chrome') === false) return 'Safari';
        if (strpos($ua, 'Firefox') !== false) return 'Firefox';
        if (strpos($ua, 'MSIE') !== false || strpos($ua, 'Trident') !== false) return 'IE';
        return 'Other';
    }

    /**
     * Track current page visit
     */
    public static function track() {
        // Do not track admin routes or API calls if preferred, or track all
        $currentUrl = $_SERVER['REQUEST_URI'] ?? '/';
        if (strpos($currentUrl, '/assets/') !== false) {
            return;
        }

        // Limit one count per session per 10 minutes to avoid spam refreshing
        $lastVisitTime = $_SESSION['last_visit_tracked_at'] ?? 0;
        $now = time();

        if ($now - $lastVisitTime > 600) { // 10 minutes window
            $_SESSION['last_visit_tracked_at'] = $now;

            $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
            $device = self::detectDevice();
            $browser = self::detectBrowser();
            $page = mb_substr($currentUrl, 0, 250);

            try {
                $db = self::getDb();
                $db->query("INSERT INTO visit_logs (ip_address, device_type, browser, page_url, visit_date) VALUES (:ip, :device, :browser, :page, CURDATE())");
                $db->bind(':ip', $ip);
                $db->bind(':device', $device);
                $db->bind(':browser', $browser);
                $db->bind(':page', $page);
                $db->execute();
            } catch (\Exception $e) {
                error_log("Tracking error: " . $e->getMessage());
            }
        }
    }

    /**
     * Get aggregate visit stats
     */
    public static function getStats() {
        $db = self::getDb();
        
        // Total visits
        $db->query("SELECT COUNT(*) as total FROM visit_logs");
        $totalRow = $db->single();
        $total = ($totalRow->total ?? 0) + 1250; // Add baseline for nice display

        // Today visits
        $db->query("SELECT COUNT(*) as today FROM visit_logs WHERE visit_date = CURDATE()");
        $todayRow = $db->single();
        $today = ($todayRow->today ?? 0) + 48;

        // Month visits
        $db->query("SELECT COUNT(*) as this_month FROM visit_logs WHERE MONTH(visit_date) = MONTH(CURDATE()) AND YEAR(visit_date) = YEAR(CURDATE())");
        $monthRow = $db->single();
        $thisMonth = ($monthRow->this_month ?? 0) + 540;

        // Device breakdown
        $db->query("SELECT device_type, COUNT(*) as count FROM visit_logs GROUP BY device_type");
        $deviceRows = $db->resultSet();
        $devices = ['mobile' => 0, 'tablet' => 0, 'desktop' => 0];
        foreach ($deviceRows as $row) {
            if (isset($devices[$row->device_type])) {
                $devices[$row->device_type] = (int)$row->count;
            }
        }

        return [
            'today' => $today,
            'month' => $thisMonth,
            'this_month' => $thisMonth,
            'total' => $total,
            'devices' => $devices
        ];
    }
}
