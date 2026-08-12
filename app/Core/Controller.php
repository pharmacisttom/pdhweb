<?php
namespace App\Core;

class Controller {
    
    // Load model
    public function model($model) {
        // Require model file
        require_once '../app/Models/' . $model . '.php';
        
        // Instantiate model
        $modelClass = 'App\\Models\\' . $model;
        return new $modelClass();
    }

    // Load view
    public function view($view, $data = [], $layout = 'main') {
        // Check for view file
        if (file_exists('../app/Views/' . $view . '.php')) {
            // Extract data to variables
            extract($data);
            
            // Require the layout which will include the view
            if ($layout && file_exists('../app/Views/layouts/' . $layout . '.php')) {
                require_once '../app/Views/layouts/' . $layout . '.php';
            } else {
                // If no layout, just require the view
                require_once '../app/Views/' . $view . '.php';
            }
        } else {
            // View does not exist
            die('View does not exist');
        }
    }

    // Redirect
    public function redirect($url) {
        header('Location: ' . URLROOT . '/' . $url);
        exit;
    }
}
