<?php
namespace App\Core;

class App {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Admin routing
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
                'login' => 'Auth'
            ];

            if (isset($url[0])) {
                $rawKey = strtolower($url[0]);
                if (isset($adminAliases[$rawKey]) && file_exists('../app/Controllers/Admin/' . $adminAliases[$rawKey] . 'Controller.php')) {
                    $this->controller = $adminAliases[$rawKey] . 'Controller';
                    unset($url[0]);
                } else if (file_exists('../app/Controllers/Admin/' . ucwords($url[0]) . 'Controller.php')) {
                    $this->controller = ucwords($url[0]) . 'Controller';
                    unset($url[0]);
                }
            }
            
            // Require the controller
            $controllerClass = 'App\\Controllers\\Admin\\' . $this->controller;
            if(!class_exists($controllerClass)){
                require_once '../app/Controllers/Admin/' . $this->controller . '.php';
            }
            $this->controller = new $controllerClass;

        } else {
            // Public routing with alias & singular/plural fallback
            $aliases = [
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
                'news' => 'News'
            ];

            if (isset($url[0])) {
                $rawKey = strtolower($url[0]);
                if (isset($aliases[$rawKey]) && file_exists('../app/Controllers/' . $aliases[$rawKey] . 'Controller.php')) {
                    $this->controller = $aliases[$rawKey] . 'Controller';
                    unset($url[0]);
                } else if (file_exists('../app/Controllers/' . ucwords($url[0]) . 'Controller.php')) {
                    $this->controller = ucwords($url[0]) . 'Controller';
                    unset($url[0]);
                } else if (str_ends_with($rawKey, 's') && file_exists('../app/Controllers/' . ucwords(rtrim($rawKey, 's')) . 'Controller.php')) {
                    $this->controller = ucwords(rtrim($rawKey, 's')) . 'Controller';
                    unset($url[0]);
                }
            }

            // Require the controller
            $controllerClass = 'App\\Controllers\\' . $this->controller;
            $this->controller = new $controllerClass;
        }

        // Check for method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Get params
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            // Remove trailing slash
            $url = rtrim($_GET['url'], '/');
            // Decode URL to allow Thai characters
            $url = urldecode($url);
            // Split by slash
            return explode('/', $url);
        }
        return [];
    }
}
