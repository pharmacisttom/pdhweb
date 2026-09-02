<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/../config/config.php';

$_SERVER['REQUEST_METHOD'] = 'GET';
$_SESSION['user_id'] = 1;
$_SESSION['user_username'] = 'admin';
$_SESSION['user_role'] = 1;
$_SESSION['user_firstname'] = 'Super';
$_SESSION['user_lastname'] = 'Admin';

$routesToTest = [
    '/' => 'Homepage with CSR Carousel & Donation Spotlight',
    '/csr' => 'Public CSR page',
    '/donations' => 'Public Donations page',
    '/donation/track' => 'Public Donation Tracking page',
    '/news' => 'Public News page',
    '/admin' => 'Admin Dashboard',
    '/admin/dashboard' => 'Admin Dashboard Direct',
    '/admin/banner' => 'Admin Banner list',
    '/admin/news' => 'Admin News list',
    '/admin/news/create' => 'Admin News Create Form',
    '/admin/department' => 'Admin Department list',
    '/admin/service' => 'Admin Service list',
    '/admin/clinic' => 'Admin Clinic list',
    '/admin/doctor' => 'Admin Doctor list',
    '/admin/doctor/create' => 'Admin Doctor Create Form',
    '/admin/donationitem' => 'Admin Donation Items list',
    '/admin/donationitem/create' => 'Admin Donation Item Create Form',
    '/admin/donation' => 'Admin Donations Check Slips list',
    '/admin/csr' => 'Admin CSR Projects list',
    '/admin/csr/create' => 'Admin CSR Project Create Form',
    '/admin/complaint' => 'Admin Complaints list',
    '/admin/procurement' => 'Admin Procurements list',
    '/admin/page' => 'Admin Pages list',
    '/admin/documents' => 'Admin Documents list',
    '/admin/settings' => 'Admin Settings page',
    '/admin/users' => 'Admin Users list',
    '/admin/logs' => 'Admin Audit Logs'
];

$passed = 0;
$failed = 0;

echo "======================================================\n";
echo "       PDHWEB ADMIN & PUBLIC ROUTES HEALTH CHECK      \n";
echo "======================================================\n";

foreach ($routesToTest as $uri => $desc) {
    $_SERVER['REQUEST_URI'] = $uri;
    
    // Capture output and errors
    ob_start();
    try {
        $router = new App\Core\Router();
        require APPROOT . '/routes/web.php';
        $router->dispatch($uri, 'GET');
        $output = ob_get_clean();
        
        // Check if output contains fatal error or exception
        if (stripos($output, 'Fatal error') !== false || stripos($output, 'Uncaught Error') !== false || stripos($output, 'Parse error') !== false) {
            echo "❌ FAIL: [{$uri}] - {$desc}\n";
            echo "   Error Output:\n" . substr(strip_tags($output), 0, 300) . "\n";
            $failed++;
        } else {
            echo "✅ PASS: [{$uri}] - {$desc} (Length: " . strlen($output) . " bytes)\n";
            $passed++;
        }
    } catch (\Throwable $e) {
        ob_end_clean();
        echo "❌ EXCEPTION: [{$uri}] - {$desc}\n";
        echo "   Message: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine() . "\n";
        $failed++;
    }
}

echo "======================================================\n";
echo " SUMMARY: Passed: {$passed} | Failed: {$failed} | Total: " . count($routesToTest) . "\n";
echo "======================================================\n";

if ($failed > 0) {
    exit(1);
} else {
    exit(0);
}
