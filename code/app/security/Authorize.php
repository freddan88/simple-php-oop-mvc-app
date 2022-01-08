<?php

declare(strict_types=1);

require_once(__DIR__ . "/../utils/Response.php");
require_once(__DIR__ . "/../utils/Route.php");

class Authorize {
    use Route;

    private $authorizedRoutes = [];
    private $currentRoute = '';

    private function urlExists()
    {
        $urlPath = $this->getCurrentRoute();
        $routes = $this->authenticatedRoutes;
        if (in_array($urlPath, $routes)) return true;
        return false;
    }

    public function route($route)
    {
        $this->currentRoute = $route;
        return $this;
    }

    public function roles($roles)
    {
        $route = $this->currentRoute;
        $this->authorizedRoutes[$route] = $roles;
        return $this;
    }

    public function debugRoutes()
    {
        if ($this->urlExists()) {
            echo "<pre>", var_dump($this->authorizedRoutes), "</pre>";
            exit;
        }
    }

    public function validate()
    {
        if ($this->urlExists()) {
            $urlPath = $this->getCurrentRoute();
            $data = ['code' => '401', 'message' => 'You are not authorized to use this resource'];
            if (str_contains($urlPath, 'api')) Response::json($data);
            Response::render('error', $data);
        }
    }
}