<?php

/**
 * Global Helper Functions
 */

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        if (isset($_ENV[$key])) {
            return $_ENV[$key];
        }
        $val = getenv($key);
        if ($val !== false) {
            return $val;
        }
        return $default;
    }
}

if (!function_exists('url')) {
    function url($path = '')
    {
        $baseUrl = defined('URLROOT') ? URLROOT : (defined('APP_URL') ? APP_URL : '');
        if (empty($baseUrl)) {
            $baseUrl = env('APP_URL', '');
        }
        return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
    }
}

if (!function_exists('asset')) {
    function asset($path = '')
    {
        return url('assets/' . ltrim($path, '/'));
    }
}

if (!function_exists('normalize_banner_link')) {
    function normalize_banner_link($link)
    {
        $link = trim(html_entity_decode((string)$link, ENT_QUOTES, 'UTF-8'));
        if ($link === '') {
            return '';
        }

        if (strpos($link, '/') === 0) {
            return url($link);
        }

        $parts = parse_url($link);
        if ($parts === false || empty($parts['scheme'])) {
            return '';
        }

        $scheme = strtolower($parts['scheme']);
        if (!in_array($scheme, ['http', 'https'], true)) {
            return '';
        }

        $host = strtolower($parts['host'] ?? '');
        if (!in_array($host, ['localhost', '127.0.0.1', '::1'], true)) {
            return $link;
        }

        // Convert legacy local development links into the current environment URL.
        $path = $parts['path'] ?? '/';
        $path = preg_replace('#^/pdhweb(?:/public)?(?=/|$)#i', '', $path);
        $resolved = url($path === '' ? '/' : $path);
        if (!empty($parts['query'])) {
            $resolved .= '?' . $parts['query'];
        }
        if (!empty($parts['fragment'])) {
            $resolved .= '#' . $parts['fragment'];
        }

        return $resolved;
    }
}

if (!function_exists('redirect')) {
    function redirect($path)
    {
        // Prevent Open Redirect: Only allow relative paths or paths starting with URLROOT
        if (preg_match('#^(https?:)?//#i', $path)) {
            if (defined('URLROOT') && strpos($path, URLROOT) !== 0) {
                $path = url('/');
            }
        } else {
            $path = url($path);
        }
        header('Location: ' . $path);
        exit;
    }
}

if (!function_exists('view')) {
    function view($viewPath, $data = [])
    {
        extract($data);
        $base = defined('APPROOT') ? APPROOT . '/app' : (defined('APP_PATH') ? APP_PATH : dirname(__DIR__));
        $file = $base . '/Views/' . str_replace('.', '/', $viewPath) . '.php';
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
        return \App\Helpers\Security::csrfToken();
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field()
    {
        return \App\Helpers\Security::csrfField();
    }
}

if (!function_exists('verify_csrf')) {
    function verify_csrf($token = null)
    {
        return \App\Helpers\Security::validateCsrf();
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
        return isset($_SESSION['user_id']) || (isset($_SESSION['user']) && in_array($_SESSION['user']['role_id'], [1, 2]));
    }
}
