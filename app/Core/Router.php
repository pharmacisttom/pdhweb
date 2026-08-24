<?php

namespace App\Core;

class Router
{
    protected $routes = [];

    public function get($uri, $controllerAction)
    {
        $this->addRoute('GET', $uri, $controllerAction);
    }

    public function post($uri, $controllerAction)
    {
        $this->addRoute('POST', $uri, $controllerAction);
    }

    protected function addRoute($method, $uri, $controllerAction)
    {
        // Convert route parameters {id} to regex
        $uriPattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[a-zA-Z0-9_-]+)', $uri);
        $uriPattern = '#^' . $uriPattern . '$#';
        
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'pattern' => $uriPattern,
            'controllerAction' => $controllerAction
        ];
    }

    public function dispatch($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['pattern'], $uri, $matches)) {
                
                // Extract named parameters
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                
                $action = explode('@', $route['controllerAction']);
                $controllerName = "App\\Controllers\\" . $action[0];
                $methodName = $action[1];
                
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $methodName)) {
                        return call_user_func_array([$controller, $methodName], $params);
                    }
                }
                
                header("HTTP/1.0 500 Internal Server Error");
                echo "Controller or Method not found.";
                return;
            }
        }
        
        // 404 Not Found
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }
}
