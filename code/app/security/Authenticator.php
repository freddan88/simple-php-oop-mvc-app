<?php

declare(strict_types=1);

require_once(__DIR__ . "/../utils/Response.php");
require_once(__DIR__ . "/../utils/Route.php");

class Authenticator {
    use Route;

    private $authenticatedRoutes = [];

    private function urlExists()
    {
        $urlPath = $this->getCurrentRoute();
        $routes = $this->authenticatedRoutes;
        if (in_array($urlPath, $routes)) return true;
        return false;
    }
    
    public function routes(array $authenticatedRoutes = [])
    {
        $this->authenticatedRoutes = $authenticatedRoutes;
        return $this;
    }

    public function getRoutes()
    {
        var_dump($this->authenticatedRoutes);
        exit;
    }

    public function validateLogin()
    {
        if ($this->urlExists()) {
            $viewData = ['code' => '401', 'message' => 'You are not authenticated'];
            Response::render('error', $viewData);
        }
    }

    public function validateApiKey()
    {
        if ($this->urlExists()) {
            $apiData = ['code' => '401', 'message' => 'You are not authenticated'];
            Response::json($apiData);
        }
    }
}