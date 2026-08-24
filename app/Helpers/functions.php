<?php

/**
 * Global Helper Functions
 */

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        static $env = null;
        if ($env === null) {
            $env = [];
            $envPath = BASE_PATH . '/.env';
            if (file_exists($envPath)) {
                $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {
                    if (strpos(trim($line), '#') === 0) continue;
                    list($name, $value) = explode('=', $line, 2);
                    $name = trim($name);
                    $value = trim($value);
                    if (preg_match('/^"(.*)"$/', $value, $matches) || preg_match("/^'(.*)'$/", $value, $matches)) {
                        $value = $matches[1];
                    }
                    $env[$name] = $value;
                }
            }
        }
        return $env[$key] ?? $default;
    }
}

if (!function_exists('url')) {
    function url($path = '')
    {
        $baseUrl = env('APP_URL', 'http://localhost/pdhweb/public');
        return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
    }
}

if (!function_exists('asset')) {
    function asset($path = '')
    {
        return url('assets/' . ltrim($path, '/'));
    }
}

if (!function_exists('redirect')) {
    function redirect($path)
    {
        header('Location: ' . url($path));
        exit;
    }
}

if (!function_exists('view')) {
    function view($viewPath, $data = [])
    {
        extract($data);
        $file = APP_PATH . '/Views/' . str_replace('.', '/', $viewPath) . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            die("View not found: {$viewPath}");
        }
    }
}

if (!function_exists('csrf_token')) {
    function csrf_token()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field()
    {
        return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
    }
}

if (!function_exists('verify_csrf')) {
    function verify_csrf($token)
    {
        if (empty($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
            die("CSRF Token Verification Failed.");
        }
        return true;
    }
}

if (!function_exists('escape')) {
    function escape($string)
    {
        return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('is_admin')) {
    function is_admin() {
        return isset($_SESSION['user']) && in_array($_SESSION['user']['role_id'], [1, 2]); // Super Admin, Website Admin
    }
}
