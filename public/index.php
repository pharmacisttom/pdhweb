<?php

// Bootstrap application configuration and autoloader
require_once __DIR__ . '/../config/config.php';

// Initialize and execute App through declarative Router
$app = new App\Core\App();
$app->run();
