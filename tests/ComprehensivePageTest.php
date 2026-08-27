<?php

require_once __DIR__ . '/../config/config.php';

$routesToTest = [
    '/' => 'Home Page',
    '/news' => 'News Index',
    '/news?category=procurement' => 'Procurement News Index',
    '/ita' => 'ITA Index',
    '/contact' => 'Contact Index',
    '/risk' => 'Risk Index',
    '/hrms' => 'HRMS Index',
    '/donation' => 'Donation Index',
    '/donations' => 'Donations Index',
    '/csr' => 'CSR Partnerships',
    '/doctors' => 'Doctors Index',
    '/clinics' => 'Clinics Index',
    '/clinic/show/1' => 'Clinic Detail',
    '/services' => 'Services Index',
    '/department' => 'Departments Index',
    '/departments' => 'Departments Index 2',
    '/procurement' => 'Procurements Index',
    '/procurements' => 'Procurements Index 2',
    '/procurement/show/1' => 'Procurement Detail',
    '/downloads' => 'Download Documents',
    '/official-documents' => 'Official Documents',
    '/complaint' => 'Complaints Index',
    '/complaints' => 'Complaints Index 2',
    '/appointment' => 'Appointment Index',
    '/appointments' => 'Appointments Index 2',
    '/queue' => 'Queue Index',
    '/queue/kiosk' => 'Queue Kiosk',
    '/page/about' => 'Page About',
    '/page/executives' => 'Page Executives',
    '/page/vision' => 'Page Vision',
    '/page/patient-rights' => 'Page Rights',
    '/login' => 'Auth Login',
    '/auth/login' => 'Auth Login 2',
    '/admin/login' => 'Admin Login',
    '/admin' => 'Admin Dashboard',
    '/admin/dashboard' => 'Admin Dashboard 2',
    '/admin/news' => 'Admin News',
    '/admin/news/create' => 'Admin News Create',
    '/admin/banner' => 'Admin Banner',
    '/admin/department' => 'Admin Department',
    '/admin/service' => 'Admin Service',
    '/admin/clinic' => 'Admin Clinic',
    '/admin/doctor' => 'Admin Doctor',
    '/admin/donationitem' => 'Admin Donation Item',
    '/admin/donation' => 'Admin Donation Slip',
    '/admin/procurement' => 'Admin Procurement',
    '/admin/complaint' => 'Admin Complaint',
    '/admin/appointment' => 'Admin Appointment',
    '/admin/queue' => 'Admin Queue',
    '/admin/page' => 'Admin Page',
    '/admin/documents' => 'Admin Documents',
    '/admin/documents/create' => 'Admin Document Upload',
    '/admin/settings' => 'Admin Settings',
    '/admin/logs' => 'Admin Logs',
];

echo "========================================================\n";
echo " Comprehensive Single-Process Page Execution Test\n";
echo "========================================================\n";

$pass = 0;
$fail = 0;

foreach ($routesToTest as $uri => $name) {
    $runnerPath = escapeshellarg(__DIR__ . '/runner.php');
    $arg = escapeshellarg($uri);
    $cmd = "php {$runnerPath} {$arg} 2>&1";
    
    $output = shell_exec($cmd);
    
    if (strpos($output, 'Fatal error') !== false || strpos($output, 'Parse error') !== false || strpos($output, '500 Internal') !== false) {
        $fail++;
        echo "  [FAIL] {$uri} ({$name})\n";
        echo "    Error snippet: " . substr(trim($output), 0, 300) . "\n";
    } else {
        $pass++;
        echo "  [PASS] {$uri} ({$name})\n";
    }
}

echo "\n========================================================\n";
echo " Total: " . count($routesToTest) . ", Passed: {$pass}, Failed: {$fail}\n";
echo "========================================================\n";
exit($fail === 0 ? 0 : 1);
