<?php
namespace App\Core;

class App {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // 1. Admin routing
        if (isset($url[0]) && strtolower($url[0]) === 'admin') {
            array_shift($url); // Remove 'admin' from url array
            
            // Default admin controller
            $this->controller = 'DashboardController';
            
            $adminAliases = [
                'donationitem' => 'DonationItem',
                'donationitems' => 'DonationItem',
                'donation' => 'Donation',
                'donations' => 'Donation',
                'banner' => 'Banner',
                'banners' => 'Banner',
                'news' => 'News',
                'appointment' => 'Appointment',
                'appointments' => 'Appointment',
                'doctor' => 'Doctor',
                'doctors' => 'Doctor',
                'clinic' => 'Clinic',
                'clinics' => 'Clinic',
                'service' => 'Service',
                'services' => 'Service',
                'department' => 'Department',
                'departments' => 'Department',
                'procurement' => 'Procurement',
                'procurements' => 'Procurement',
                'complaint' => 'Complaint',
                'complaints' => 'Complaint',
                'setting' => 'Settings',
                'settings' => 'Settings',
                'auditlog' => 'AuditLog',
                'logs' => 'AuditLog',
                'dashboard' => 'Dashboard',
                'auth' => 'Auth',
                'login' => 'Auth',
                'page' => 'Page',
                'pages' => 'Page'
            ];

            if (isset($url[0])) {
                $rawKey = strtolower($url[0]);
                if (isset($adminAliases[$rawKey]) && file_exists(APPROOT . '/app/Controllers/Admin/' . $adminAliases[$rawKey] . 'Controller.php')) {
                    $this->controller = $adminAliases[$rawKey] . 'Controller';
                    array_shift($url);
                } else if (file_exists(APPROOT . '/app/Controllers/Admin/' . ucfirst($url[0]) . 'Controller.php')) {
                    $this->controller = ucfirst($url[0]) . 'Controller';
                    array_shift($url);
                }
            }
            
            // Require the admin controller
            $controllerClass = 'App\\Controllers\\Admin\\' . $this->controller;
            if (!class_exists($controllerClass)) {
                $file = APPROOT . '/app/Controllers/Admin/' . $this->controller . '.php';
                if (file_exists($file)) {
                    require_once $file;
                }
            }
            $this->controller = new $controllerClass;

        } else {
            // 2. Public routing with aliases & case normalization for Linux
            $aliases = [
                'auth' => 'Auth',
                'login' => 'Auth',
                'donations' => 'Donation',
                'donation' => 'Donation',
                'doctors' => 'Doctor',
                'doctor' => 'Doctor',
                'clinics' => 'Clinic',
                'clinic' => 'Clinic',
                'services' => 'Service',
                'service' => 'Service',
                'appointments' => 'Appointment',
                'appointment' => 'Appointment',
                'departments' => 'Department',
                'department' => 'Department',
                'hrms' => 'Risk',
                'risk' => 'Risk',
                'ita' => 'Ita',
                'contact' => 'Contact',
                'news' => 'News',
                'pages' => 'Page',
                'page' => 'Page',
                'procurement' => 'Procurement',
                'procurements' => 'Procurement',
                'complaint' => 'Complaint',
                'complaints' => 'Complaint'
            ];

            if (isset($url[0])) {
                $rawKey = strtolower($url[0]);
                if (isset($aliases[$rawKey]) && file_exists(APPROOT . '/app/Controllers/' . $aliases[$rawKey] . 'Controller.php')) {
                    $this->controller = $aliases[$rawKey] . 'Controller';
                    array_shift($url);
                } else if (file_exists(APPROOT . '/app/Controllers/' . ucfirst($url[0]) . 'Controller.php')) {
                    $this->controller = ucfirst($url[0]) . 'Controller';
                    array_shift($url);
                } else if (str_ends_with($rawKey, 's') && file_exists(APPROOT . '/app/Controllers/' . ucfirst(rtrim($rawKey, 's')) . 'Controller.php')) {
                    $this->controller = ucfirst(rtrim($rawKey, 's')) . 'Controller';
                    array_shift($url);
                }
            }

            // Require the public controller
            $controllerClass = 'App\\Controllers\\' . $this->controller;
            if (!class_exists($controllerClass)) {
                $file = APPROOT . '/app/Controllers/' . $this->controller . '.php';
                if (file_exists($file)) {
                    require_once $file;
                }
            }
            $this->controller = new $controllerClass;
        }

        // 3. Check for method (now that $url was array_shifted, $url[0] is the method)
        if (isset($url[0])) {
            if (method_exists($this->controller, $url[0])) {
                $this->method = $url[0];
                array_shift($url);
            }
        }

        // 4. Get params
        $this->params = $url ? array_values($url) : [];

        // 5. Execute action
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (!empty($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = urldecode($url);
            return explode('/', filter_var($url, FILTER_SANITIZE_URL));
        }

        // Fallback for Apache/Nginx on VPS environments (REQUEST_URI parsing)
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        if ($uri !== '') {
            $uriPath = parse_url($uri, PHP_URL_PATH);
            $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
            $basePath = preg_replace('#/public$#i', '', $scriptDir);
            
            if (!empty($basePath) && $basePath !== '/' && strpos($uriPath, $basePath) === 0) {
                $uriPath = substr($uriPath, strlen($basePath));
            }
            if (strpos($uriPath, '/public') === 0) {
                $uriPath = substr($uriPath, 7);
            }
            if (strpos($uriPath, '/index.php') === 0) {
                $uriPath = substr($uriPath, 10);
            }
            
            $url = trim($uriPath, '/');
            if (!empty($url)) {
                $url = urldecode($url);
                return explode('/', filter_var($url, FILTER_SANITIZE_URL));
            }
        }

        return [];
    }
}
