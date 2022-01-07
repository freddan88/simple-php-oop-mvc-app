<?php

declare(strict_types=1);

require_once(__DIR__ . "/../utils/Response.php");
require_once(__DIR__ . "/../utils/Route.php");

class Authorize {
    use Route;

    private $authorizedRoutes = [];

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
        $urlPath = $this->getCurrentRoute();
        $routes = $this->authorizedRoutes;
        if ($routes[$urlPath]) {
            $data = ['code' => '401', 'message' => 'You are not authorized to use this resource'];
            if (str_contains($urlPath, 'api')) Response::json($data);
            Response::render('error', $data);
        }
    }
}