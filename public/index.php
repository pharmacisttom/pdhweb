<?php
// Autoload core files
require_once '../config/config.php';

// Simple autoloader for Core classes
spl_autoload_register(function($className) {
    // Only autoload App\Core for now
    if (strpos($className, 'App\\Core\\') === 0) {
        $class = str_replace('App\\Core\\', '', $className);
        require_once '../app/Core/' . $class . '.php';
    } else if (strpos($className, 'App\\Controllers\\') === 0) {
        $class = str_replace('App\\Controllers\\', '', $className);
        require_once '../app/Controllers/' . $class . '.php';
    } else if (strpos($className, 'App\\Models\\') === 0) {
        $class = str_replace('App\\Models\\', '', $className);
        require_once '../app/Models/' . $class . '.php';
    } else if (strpos($className, 'App\\Services\\') === 0) {
        $class = str_replace('App\\Services\\', '', $className);
        require_once '../app/Services/' . $class . '.php';
    } else if (strpos($className, 'App\\Repositories\\') === 0) {
        $class = str_replace('App\\Repositories\\', '', $className);
        require_once '../app/Repositories/' . $class . '.php';
    } else if (strpos($className, 'App\\Middleware\\') === 0) {
        $class = str_replace('App\\Middleware\\', '', $className);
        require_once '../app/Middleware/' . $class . '.php';
    } else if (strpos($className, 'App\\Helpers\\') === 0) {
        $class = str_replace('App\\Helpers\\', '', $className);
        require_once '../app/Helpers/' . $class . '.php';
    } else if (strpos($className, 'App\\Validation\\') === 0) {
        $class = str_replace('App\\Validation\\', '', $className);
        require_once '../app/Validation/' . $class . '.php';
    }
});

// Initialize the App
$app = new App\Core\App();
