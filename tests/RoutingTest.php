<?php

/**
 * Comprehensive Cross-Environment Routing & Architecture Test Suite
 * Tests URL parsing, Route dispatching, Controller execution, Parameter matching, and 404 responses
 */

require_once __DIR__ . '/../config/config.php';

class RoutingTest
{
    private $passed = 0;
    private $failed = 0;
    private $router;

    public function __construct()
    {
        $this->router = new App\Core\Router();
        $router = $this->router;
        require APPROOT . '/routes/web.php';
    }

    public function assert($description, $condition)
    {
        if ($condition) {
            $this->passed++;
            echo "  [PASS] {$description}\n";
        } else {
            $this->failed++;
            echo "  [FAIL] {$description}\n";
        }
    }

    public function testUrlParsing()
    {
        echo "\n--- 1. Testing URL Parsing Across Environments ---\n";

        // Test 1: Nginx Domain Root (/admin/login)
        $_SERVER['REQUEST_URI'] = '/admin/login';
        $_SERVER['SCRIPT_NAME'] = '/index.php';
        unset($_GET['url']);
        $path = App\Core\Router::getRequestPath();
        $this->assert("Nginx root /admin/login parses as '/admin/login'", $path === '/admin/login');

        // Test 2: Nginx with Query String (/news?category=health&page=1)
        $_SERVER['REQUEST_URI'] = '/news?category=health&page=1';
        $_SERVER['SCRIPT_NAME'] = '/index.php';
        unset($_GET['url']);
        $path = App\Core\Router::getRequestPath();
        $this->assert("Nginx with query string /news?category=health parses as '/news'", $path === '/news');

        // Test 3: XAMPP Subdirectory (/pdhweb/admin/login)
        $_SERVER['REQUEST_URI'] = '/pdhweb/admin/login';
        $_SERVER['SCRIPT_NAME'] = '/pdhweb/public/index.php';
        unset($_GET['url']);
        $path = App\Core\Router::getRequestPath();
        $this->assert("XAMPP Subdirectory /pdhweb/admin/login parses as '/admin/login'", $path === '/admin/login');

        // Test 4: XAMPP Subdirectory Root (/pdhweb/)
        $_SERVER['REQUEST_URI'] = '/pdhweb/';
        $_SERVER['SCRIPT_NAME'] = '/pdhweb/public/index.php';
        unset($_GET['url']);
        $path = App\Core\Router::getRequestPath();
        $this->assert("XAMPP Subdirectory root /pdhweb/ parses as '/'", $path === '/');

        // Test 5: Apache .htaccess rewrite with ?url= parameter
        $_SERVER['REQUEST_URI'] = '/pdhweb/index.php?url=admin/dashboard';
        $_SERVER['SCRIPT_NAME'] = '/pdhweb/public/index.php';
        $_GET['url'] = 'admin/dashboard';
        $path = App\Core\Router::getRequestPath();
        $this->assert("Apache with ?url=admin/dashboard parses as '/admin/dashboard'", $path === '/admin/dashboard');

        // Test 6: Trailing Slash Normalization (/services/)
        $_SERVER['REQUEST_URI'] = '/services/';
        $_SERVER['SCRIPT_NAME'] = '/index.php';
        unset($_GET['url']);
        $path = App\Core\Router::getRequestPath();
        $this->assert("Trailing slash /services/ normalizes to '/services'", $path === '/services');

        // Test 7: Thai public slugs must survive URL normalization.
        $_SERVER['REQUEST_URI'] = '/news/ประกาศผู้ชนะการเสนอราคา';
        $_SERVER['SCRIPT_NAME'] = '/index.php';
        unset($_GET['url']);
        $path = App\Core\Router::getRequestPath();
        $this->assert("Thai news slug is preserved", $path === '/news/ประกาศผู้ชนะการเสนอราคา');
    }

    public function testRouteDispatching()
    {
        echo "\n--- 2. Testing Route Dispatching & Controller Execution ---\n";
        $_SERVER['REQUEST_METHOD'] = 'GET';

        // Test 1: GET /admin/login
        $_SERVER['REQUEST_URI'] = '/admin/login';
        ob_start();
        $this->router->dispatch('/admin/login', 'GET');
        $output = ob_get_clean();
        $this->assert("GET /admin/login executes Admin\\AuthController@login and renders login page", strpos($output, 'เข้าสู่ระบบหลังบ้าน') !== false);

        // Test 2: GET /auth/login
        $_SERVER['REQUEST_URI'] = '/auth/login';
        ob_start();
        $this->router->dispatch('/auth/login', 'GET');
        $output = ob_get_clean();
        $this->assert("GET /auth/login executes AuthController@login and renders login page", strpos($output, 'เข้าสู่ระบบหลังบ้าน') !== false);

        // Test 3: GET / (Home Page)
        $_SERVER['REQUEST_URI'] = '/';
        ob_start();
        $this->router->dispatch('/', 'GET');
        $output = ob_get_clean();
        $this->assert("GET / executes HomeController@index and renders Home page", strpos($output, 'โรงพยาบาลปลวกแดง') !== false);

        // Test 4: GET /page/about
        $_SERVER['REQUEST_URI'] = '/page/about';
        ob_start();
        $this->router->dispatch('/page/about', 'GET');
        $output = ob_get_clean();
        $this->assert("GET /page/about executes PageController@about", strlen($output) > 500);

        // Test 5: GET /news
        $_SERVER['REQUEST_URI'] = '/news';
        ob_start();
        $this->router->dispatch('/news', 'GET');
        $output = ob_get_clean();
        $this->assert("GET /news executes NewsController@index", strlen($output) > 500);

        // Test 6: GET /donations
        $_SERVER['REQUEST_URI'] = '/donations';
        ob_start();
        $this->router->dispatch('/donations', 'GET');
        $output = ob_get_clean();
        $this->assert("GET /donations executes DonationController@index", strlen($output) > 500);

        // Test 7: GET /services
        $_SERVER['REQUEST_URI'] = '/services';
        ob_start();
        $this->router->dispatch('/services', 'GET');
        $output = ob_get_clean();
        $this->assert("GET /services executes ServiceController@index", strlen($output) > 500);

        // Test 8: GET /doctors
        $_SERVER['REQUEST_URI'] = '/doctors';
        ob_start();
        $this->router->dispatch('/doctors', 'GET');
        $output = ob_get_clean();
        $this->assert("GET /doctors executes DoctorController@index", strlen($output) > 500);

        // Test 9: GET /clinics
        $_SERVER['REQUEST_URI'] = '/clinics';
        ob_start();
        $this->router->dispatch('/clinics', 'GET');
        $output = ob_get_clean();
        $this->assert("GET /clinics executes ClinicController@index", strlen($output) > 500);

        // Test 10: GET /ita
        $_SERVER['REQUEST_URI'] = '/ita';
        ob_start();
        $this->router->dispatch('/ita', 'GET');
        $output = ob_get_clean();
        $this->assert("GET /ita executes ItaController@index", strlen($output) > 500);

        // Test 11: GET /contact
        $_SERVER['REQUEST_URI'] = '/contact';
        ob_start();
        $this->router->dispatch('/contact', 'GET');
        $output = ob_get_clean();
        $this->assert("GET /contact executes ContactController@index", strlen($output) > 500);

        // Test 12: GET /procurement
        $_SERVER['REQUEST_URI'] = '/procurement';
        ob_start();
        $this->router->dispatch('/procurement', 'GET');
        $output = ob_get_clean();
        $this->assert("GET /procurement executes ProcurementController@index", strlen($output) > 500);

        // Test 13: GET /complaint
        $_SERVER['REQUEST_URI'] = '/complaint';
        ob_start();
        $this->router->dispatch('/complaint', 'GET');
        $output = ob_get_clean();
        $this->assert("GET /complaint executes ComplaintController@index", strlen($output) > 500);

        // Test 14: GET /appointment
        $_SERVER['REQUEST_URI'] = '/appointment';
        ob_start();
        $this->router->dispatch('/appointment', 'GET');
        $output = ob_get_clean();
        $this->assert("GET /appointment executes AppointmentController@index", strlen($output) > 500);

        // Test 15: GET /queue
        $_SERVER['REQUEST_URI'] = '/queue';
        ob_start();
        $this->router->dispatch('/queue', 'GET');
        $output = ob_get_clean();
        $this->assert("GET /queue executes QueueController@index", strlen($output) > 500);

        // Test 16: Parameter Route GET /page/vision
        $_SERVER['REQUEST_URI'] = '/page/vision';
        ob_start();
        $this->router->dispatch('/page/vision', 'GET');
        $output = ob_get_clean();
        $this->assert("GET /page/vision executes PageController@vision", strlen($output) > 500);

        // Test 17: GET /this-route-does-not-exist (Must return 404, NOT Home Page)
        $_SERVER['REQUEST_URI'] = '/this-route-does-not-exist';
        ob_start();
        $this->router->dispatch('/this-route-does-not-exist', 'GET');
        $output = ob_get_clean();
        $statusCode = http_response_code();
        $this->assert("GET /this-route-does-not-exist sets HTTP status 404", $statusCode === 404);
        $this->assert("GET /this-route-does-not-exist renders 404 view and NOT Home Page", strpos($output, '404') !== false && strpos($output, 'hero-slider') === false);
    }

    public function testAdminProtectedRoutes()
    {
        echo "\n--- 3. Testing Admin Protected Routes with Auth Session ---\n";
        $_SERVER['REQUEST_METHOD'] = 'GET';
        // Simulate active authenticated admin session
        $_SESSION['user_id'] = 1;
        $_SESSION['user_username'] = 'admin';
        $_SESSION['user_firstname'] = 'Super';
        $_SESSION['user_lastname'] = 'Administrator';
        $_SESSION['user_role'] = 1;

        $adminRoutes = [
            '/admin' => 'DashboardController@index',
            '/admin/dashboard' => 'DashboardController@index',
            '/admin/news' => 'NewsController@index',
            '/admin/banner' => 'BannerController@index',
            '/admin/department' => 'DepartmentController@index',
            '/admin/service' => 'ServiceController@index',
            '/admin/clinic' => 'ClinicController@index',
            '/admin/doctor' => 'DoctorController@index',
            '/admin/donationitem' => 'DonationItemController@index',
            '/admin/donation' => 'DonationController@index',
            '/admin/procurement' => 'ProcurementController@index',
            '/admin/complaint' => 'ComplaintController@index',
            '/admin/appointment' => 'AppointmentController@index',
            '/admin/page' => 'PageController@index',
            '/admin/settings' => 'SettingsController@index',
            '/admin/logs' => 'AuditLogController@index',
        ];

        foreach ($adminRoutes as $uri => $expectedAction) {
            $_SERVER['REQUEST_URI'] = $uri;
            ob_start();
            $this->router->dispatch($uri, 'GET');
            $output = ob_get_clean();
            $this->assert("Admin Route GET {$uri} executes {$expectedAction} cleanly", strlen($output) > 200);
        }

        // Clear simulated session
        unset($_SESSION['user_id']);
    }

    public function run()
    {
        echo "========================================================\n";
        echo " PDHWeb Industrial-Grade Cross-Environment Routing Tests\n";
        echo "========================================================\n";
        $this->testUrlParsing();
        $this->testRouteDispatching();
        $this->testAdminProtectedRoutes();
        echo "\n========================================================\n";
        echo " Test Results: Passed: {$this->passed}, Failed: {$this->failed}\n";
        echo "========================================================\n";
        return $this->failed === 0;
    }
}

$test = new RoutingTest();
$success = $test->run();
exit($success ? 0 : 1);
