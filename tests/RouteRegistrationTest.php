<?php

require_once __DIR__ . '/../config/config.php';

$app = new App\Core\App();
$routes = $app->getRouter()->getRoutes();
$registered = [];
foreach ($routes as $route) {
    foreach ($route['methods'] as $method) {
        $registered[$method . ' ' . $route['uri']] = true;
    }
}

$expected = [
    'GET /complaint/track',
    'GET /complaint/success/{tracking_code}',
    'GET /appointment/getSlots',
    'GET /appointment/ticket/{ref}',
    'POST /queue/getTicket',
    'GET /queue/ticket/{id}',
    'GET /queue/room/{room_number}',
    'GET /queue/door/{room_number}',
    'GET /queue/display/{department_id}',
    'POST /admin/queue/callNext',
    'POST /admin/queue/action/{id}',
    'POST /admin/queue/fastTicket',
    'GET /api',
    'GET /api/social',
    'GET /admin/users',
    'POST /admin/users/create',
    'POST /admin/settings/updateFeatures',
    'GET /csr',
    'GET /admin/csr',
    'POST /admin/csr/create',
    'GET /procurement/show/{id}',
];

$failed = 0;
foreach ($expected as $route) {
    if (isset($registered[$route])) {
        echo "[PASS] {$route}\n";
    } else {
        echo "[FAIL] {$route}\n";
        $failed++;
    }
}

exit($failed === 0 ? 0 : 1);
