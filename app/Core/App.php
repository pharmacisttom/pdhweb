<?php

namespace App\Core;

class App
{
    protected $router;

    public function __construct($router = null)
    {
        if ($router instanceof Router) {
            $this->router = $router;
        } else {
            $this->router = new Router();
            $this->loadRoutes();
        }
    }

    protected function loadRoutes()
    {
        $router = $this->router;
        $routesFile = APPROOT . '/routes/web.php';
        if (file_exists($routesFile)) {
            require_once $routesFile;
        }
    }

    public function run()
    {
        return $this->router->dispatch();
    }

    public function getRouter()
    {
        return $this->router;
    }
}
