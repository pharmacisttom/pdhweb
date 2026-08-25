<?php
// Autoload core files
require_once __DIR__ . '/../config/config.php';

// Simple autoloader for Core classes
spl_autoload_register(function($className) {
    if (strpos($className, 'App\\Core\\') === 0) {
        $class = str_replace('App\\Core\\', '', $className);
        $file = __DIR__ . '/../app/Core/' . $class . '.php';
        if (file_exists($file)) require_once $file;
    } else if (strpos($className, 'App\\Controllers\\Admin\\') === 0) {
        $class = str_replace('App\\Controllers\\Admin\\', '', $className);
        $file = __DIR__ . '/../app/Controllers/Admin/' . $class . '.php';
        if (file_exists($file)) require_once $file;
    } else if (strpos($className, 'App\\Controllers\\') === 0) {
        $class = str_replace('App\\Controllers\\', '', $className);
        $file = __DIR__ . '/../app/Controllers/' . $class . '.php';
        if (file_exists($file)) require_once $file;
    } else if (strpos($className, 'App\\Models\\') === 0) {
        $class = str_replace('App\\Models\\', '', $className);
        $file = __DIR__ . '/../app/Models/' . $class . '.php';
        if (file_exists($file)) require_once $file;
    } else if (strpos($className, 'App\\Services\\') === 0) {
        $class = str_replace('App\\Services\\', '', $className);
        $file = __DIR__ . '/../app/Services/' . $class . '.php';
        if (file_exists($file)) require_once $file;
    } else if (strpos($className, 'App\\Repositories\\') === 0) {
        $class = str_replace('App\\Repositories\\', '', $className);
        $file = __DIR__ . '/../app/Repositories/' . $class . '.php';
        if (file_exists($file)) require_once $file;
    } else if (strpos($className, 'App\\Middleware\\') === 0) {
        $class = str_replace('App\\Middleware\\', '', $className);
        $file = __DIR__ . '/../app/Middleware/' . $class . '.php';
        if (file_exists($file)) require_once $file;
    } else if (strpos($className, 'App\\Helpers\\') === 0) {
        $class = str_replace('App\\Helpers\\', '', $className);
        $file = __DIR__ . '/../app/Helpers/' . $class . '.php';
        if (file_exists($file)) require_once $file;
    } else if (strpos($className, 'App\\Validation\\') === 0) {
        $class = str_replace('App\\Validation\\', '', $className);
        $file = __DIR__ . '/../app/Validation/' . $class . '.php';
        if (file_exists($file)) require_once $file;
    }
});

// Initialize the App
$app = new App\Core\App();
