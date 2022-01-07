<?php

declare(strict_types=1);

require_once(__DIR__ . "/../utils/Response.php");

class Authenticator {

    private $authenticatedRoutes = [];

    private function getRoute()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $urlPath = parse_url($uri, PHP_URL_PATH);
        $urlPath = '/' . trim($urlPath,'/');
        return $urlPath;
    }

    public function setRoutes(array $authenticatedRoutes = [])
    {
        $this->authenticatedRoutes = $authenticatedRoutes;
        return $this;
    }

    public function validateLogin()
    {
        $urlPath = $this->getRoute();
        $routes = $this->authenticatedRoutes;
        if (in_array($urlPath, $routes)) {
            $viewData = ['code' => '401', 'message' => 'You are not authenticated'];
            Response::render('error', $viewData);
        }
    }

    public function validateApiKey()
    {
        $urlPath = $this->getRoute();
        $routes = $this->authenticatedRoutes;
        if (in_array($urlPath, $routes)) {
            $apiData = ['code' => '401', 'message' => 'You are not authenticated'];
            Response::json($apiData);
        }
    }
}