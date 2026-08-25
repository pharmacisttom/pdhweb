<?php

require_once __DIR__ . '/../config/config.php';

$uri = $argv[1] ?? '/';
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['REQUEST_URI'] = $uri;
$_SESSION['user_id'] = 1;
$_SESSION['user_username'] = 'admin';
$_SESSION['user_role'] = 1;
$_SESSION['user_firstname'] = 'Super';
$_SESSION['user_lastname'] = 'Admin';

$router = new App\Core\Router();
require APPROOT . '/routes/web.php';
$router->dispatch($uri, 'GET');
