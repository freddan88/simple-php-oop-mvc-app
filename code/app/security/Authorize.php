<?php

declare(strict_types=1);

class Authorize {
    private $authorizedRoutes = [];

    private function getRoute()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $urlPath = parse_url($uri, PHP_URL_PATH);
        $urlPath = '/' . trim($urlPath,'/');
        return $urlPath;
    }

    public function setRoute($route, $roles)
    {
        $this->authorizedRoutes[$route] = $roles;
        return $this;
    }

    public function getAuthorizedRoutes()
    {
        die(var_dump($this->authorizedRoutes));
    }

    public function validateAuthorization()
    {
        $urlPath = $this->getRoute();
        $routes = $this->authorizedRoutes;
        if ($routes[$urlPath]) {
            $data = ['code' => '401', 'message' => 'You are not authorized to use this resource'];
            if (str_contains($urlPath, 'api')) Response::json($data);
            Response::render('error', $data);
        }
    }
}