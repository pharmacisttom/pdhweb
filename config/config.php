<?php

// Basic implementation of .env parsing for this project
$envFilePath = __DIR__ . '/../.env';
if (file_exists($envFilePath)) {
    $lines = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        
        // Remove quotes if present
        if (strpos($value, '"') === 0 && strrpos($value, '"') === strlen($value) - 1) {
            $value = substr($value, 1, -1);
        }
        
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

// Define some constants for easy access
define('APP_URL', $_ENV['APP_URL'] ?? 'http://localhost/pdhweb');
define('APP_NAME', $_ENV['APP_NAME'] ?? 'PDH Web');
define('APP_ENV', $_ENV['APP_ENV'] ?? 'development');

// Database configuration
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_NAME', $_ENV['DB_DATABASE'] ?? 'pdhweb');
define('DB_USER', $_ENV['DB_USERNAME'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASSWORD'] ?? '');

// Paths
define('APPROOT', dirname(dirname(__FILE__)));
define('URLROOT', APP_URL);
define('SITENAME', APP_NAME);

// Start Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
