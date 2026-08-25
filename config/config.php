<?php

// Basic implementation of .env parsing for this project
$envFilePath = __DIR__ . '/../.env';
if (file_exists($envFilePath)) {
    $lines = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $name = trim($parts[0]);
            $value = trim($parts[1]);
            
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
}

// Dynamic Base URL Auto-Detection for localhost and VPS / Custom Domains
$autoScheme = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] == 1)) 
    || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') 
    ? 'https' : 'http';

$autoHost = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$basePath = preg_replace('#/public$#i', '', $scriptDir);
$basePath = ($basePath === '/' || $basePath === '\\' || $basePath === '.') ? '' : $basePath;
$detectedUrl = $autoScheme . '://' . $autoHost . $basePath;

$configuredUrl = $_ENV['APP_URL'] ?? '';

// If configured URL is empty, or is localhost while accessed via a real domain/IP
if (empty($configuredUrl) || (strpos($configuredUrl, 'localhost') !== false && !in_array($autoHost, ['localhost', '127.0.0.1']))) {
    define('APP_URL', rtrim($detectedUrl, '/'));
} else {
    define('APP_URL', rtrim($configuredUrl, '/'));
}

define('APP_NAME', $_ENV['APP_NAME'] ?? 'โรงพยาบาลปลวกแดง');
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
