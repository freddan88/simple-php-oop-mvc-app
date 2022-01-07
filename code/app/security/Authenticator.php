<?php

declare(strict_types=1);

require_once(__DIR__ . "/../utils/Response.php");
require_once(__DIR__ . "/../utils/Route.php");

class Authenticator {
    use Route;

    private $authenticatedRoutes = [];
    
    public function setRoutes(array $authenticatedRoutes = [])
    {
        $this->authenticatedRoutes = $authenticatedRoutes;
        return $this;
    }

    public function getAuthenticatedRoutes()
    {
        die(var_dump($this->authenticatedRoutes));
    }

    public function validateLogin()
    {
        $urlPath = $this->getCurrentRoute();
        $routes = $this->authenticatedRoutes;
        if (in_array($urlPath, $routes)) {
            $viewData = ['code' => '401', 'message' => 'You are not authenticated'];
            Response::render('error', $viewData);
        }
    }

    public function validateApiKey()
    {
        $urlPath = $this->getCurrentRoute();
        $routes = $this->authenticatedRoutes;
        if (in_array($urlPath, $routes)) {
            $apiData = ['code' => '401', 'message' => 'You are not authenticated'];
            Response::json($apiData);
        }
    }
}