<?php
namespace App\Core;

class Controller {
    
    // Load model
    public function model($model) {
        $modelClass = 'App\\Models\\' . $model;
        if (class_exists($modelClass)) {
            return new $modelClass();
        }
        $modelPath = APPROOT . '/app/Models/' . $model . '.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $modelClass();
        }
        return null;
    }

    // Load view
    public function view($view, $data = [], $layout = 'main') {
        $viewPath = APPROOT . '/app/Views/' . $view . '.php';
        
        // Check for view file
        if (file_exists($viewPath)) {
            // Extract data to variables
            extract($data);
            
            // Require the layout which will include the view
            if ($layout && file_exists(APPROOT . '/app/Views/layouts/' . $layout . '.php')) {
                require APPROOT . '/app/Views/layouts/' . $layout . '.php';
            } else {
                // If no layout, just require the view
                require $viewPath;
            }
        } else {
            // View does not exist
            http_response_code(404);
            die("View '{$view}' does not exist");
        }
    }

    // Return JSON response for REST APIs
    public function json($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    // Set flash message
    public function setFlash($name, $message, $type = 'success') {
        if (!isset($_SESSION['flash'])) {
            $_SESSION['flash'] = [];
        }
        $_SESSION['flash'][$name] = [
            'message' => $message,
            'type' => $type
        ];
    }

    // Get and clear flash message
    public function getFlash($name) {
        if (isset($_SESSION['flash'][$name])) {
            $flash = $_SESSION['flash'][$name];
            unset($_SESSION['flash'][$name]);
            return $flash;
        }
        return null;
    }

    // Check request method
    public function isPost() {
        return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
    }

    public function isGet() {
        return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET';
    }

    public function isAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    // Get POST data
    public function getPost($key = null, $default = null) {
        if ($key === null) {
            return $_POST;
        }
        return $_POST[$key] ?? $default;
    }

    // Get GET / Query data
    public function getQuery($key = null, $default = null) {
        if ($key === null) {
            return $_GET;
        }
        return $_GET[$key] ?? $default;
    }

    // Redirect
    public function redirect($url) {
        $target = (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) 
            ? $url 
            : URLROOT . '/' . ltrim($url, '/');
        header('Location: ' . $target);
        exit;
    }
}
