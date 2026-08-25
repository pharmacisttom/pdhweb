<?php

namespace App\Core;

class Router
{
    protected $routes = [];

    public function get($uri, $controllerAction)
    {
        $this->addRoute(['GET', 'HEAD'], $uri, $controllerAction);
    }

    public function post($uri, $controllerAction)
    {
        $this->addRoute(['POST'], $uri, $controllerAction);
    }

    public function put($uri, $controllerAction)
    {
        $this->addRoute(['PUT'], $uri, $controllerAction);
    }

    public function delete($uri, $controllerAction)
    {
        $this->addRoute(['DELETE'], $uri, $controllerAction);
    }

    public function any($uri, $controllerAction)
    {
        $this->addRoute(['GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'OPTIONS'], $uri, $controllerAction);
    }

    protected function addRoute($methods, $uri, $controllerAction)
    {
        $uri = '/' . trim($uri, '/');
        if ($uri === '//') {
            $uri = '/';
        }

        // Convert route parameters {param} or {id} or {slug} to regex
        // Supports Thai characters, alphanumeric, hyphen, underscore
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[a-zA-Z0-9_\-\p{Thai}]+)', $uri);
        // Make trailing slash optional
        if ($uri === '/') {
            $pattern = '#^/?$#u';
        } else {
            $pattern = '#^' . $pattern . '/?$#u';
        }

        $this->routes[] = [
            'methods' => (array)$methods,
            'uri' => $uri,
            'pattern' => $pattern,
            'controllerAction' => $controllerAction
        ];
    }

    public function dispatch($uri = null, $method = null)
    {
        if ($uri === null) {
            $uri = self::getRequestPath();
        }
        if ($method === null) {
            $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        }

        $uri = self::normalizePath($uri);
        $method = strtoupper($method);

        $methodNotAllowed = false;

        foreach ($this->routes as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                // Path matched, now check HTTP method
                if (!in_array($method, $route['methods'])) {
                    $methodNotAllowed = true;
                    continue;
                }

                // Extract named parameters
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Handle Controller@Method or Closure
                if (is_callable($route['controllerAction'])) {
                    return call_user_func_array($route['controllerAction'], $params);
                }

                $action = explode('@', $route['controllerAction']);
                $controllerName = $action[0];
                $methodName = $action[1] ?? 'index';

                // Add namespace if not fully qualified
                if (strpos($controllerName, 'App\\Controllers\\') !== 0) {
                    $controllerClass = "App\\Controllers\\" . $controllerName;
                } else {
                    $controllerClass = $controllerName;
                }

                if (!class_exists($controllerClass)) {
                    // Try to require the file directly
                    $relativePath = str_replace(['App\\Controllers\\', '\\'], ['', '/'], $controllerClass);
                    $file = APPROOT . '/app/Controllers/' . $relativePath . '.php';
                    if (file_exists($file)) {
                        require_once $file;
                    }
                }

                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();
                    if (method_exists($controller, $methodName)) {
                        return call_user_func_array([$controller, $methodName], $params);
                    }
                }

                // Controller or Method not found -> 500
                http_response_code(500);
                echo "<h1>500 Internal Server Error</h1><p>Controller or Action [{$controllerClass}@{$methodName}] not found.</p>";
                return false;
            }
        }

        if ($methodNotAllowed) {
            http_response_code(405);
            echo "<h1>405 Method Not Allowed</h1>";
            return false;
        }

        // 404 Not Found
        http_response_code(404);
        $custom404 = APPROOT . '/app/Views/pages/404.php';
        if (file_exists($custom404)) {
            $data = ['page_title' => 'ไม่พบหน้าที่ต้องการ (404 Not Found)'];
            extract($data);
            $layout = APPROOT . '/app/Views/layouts/main.php';
            $view = 'pages/404';
            if (file_exists($layout)) {
                require $layout;
            } else {
                require $custom404;
            }
        } else {
            echo "<h1>404 Not Found</h1><p>The requested URL {$uri} was not found on this server.</p>";
        }
        return false;
    }

    public static function getRequestPath()
    {
        // 1. If explicit query parameter 'url' is passed (from Apache .htaccess)
        if (!empty($_GET['url'])) {
            return self::normalizePath($_GET['url']);
        }

        // 2. Extract path from REQUEST_URI (Standard for Nginx and Apache)
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';

        // 3. Determine base folder (e.g. /pdhweb/public or /pdhweb or /)
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $scriptDir = str_replace('\\', '/', dirname($scriptName));
        $baseDir = preg_replace('#/public$#i', '', $scriptDir);

        if (!empty($baseDir) && $baseDir !== '/' && $baseDir !== '.' && strpos($path, $baseDir) === 0) {
            $path = substr($path, strlen($baseDir));
        }

        if (strpos($path, '/public') === 0) {
            $path = substr($path, 7);
        }

        if (strpos($path, '/index.php') === 0) {
            $path = substr($path, 10);
        }

        return self::normalizePath($path);
    }

    public static function normalizePath($path)
    {
        $path = urldecode((string)$path);
        $path = filter_var($path, FILTER_SANITIZE_URL);
        $path = '/' . trim($path, '/');
        return ($path === '//' || $path === '') ? '/' : $path;
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
