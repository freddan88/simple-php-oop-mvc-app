<?php

declare(strict_types=1);

class Router {
    static $routes = [
        'default' => [
            'controllerMethod' => 'default',
            'controllerName' => PageController::class,
        ]
    ];

    private static function getControllerInfo($path)
    {
        $controllerInfo = self::$routes[$path];

        if (!$controllerInfo) return self::$routes['default'];

        return $controllerInfo;
    }

    public static function routeAdd($path, $controller, $method)
    {
        self::$routes[$path]['controllerMethod'] = $method;
        self::$routes[$path]['controllerName'] = $controller;
    }

    public static function loadController()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $path = parse_url($uri, PHP_URL_PATH);

        $controllerInfo = Self::getControllerInfo($path);
        $controllerName = $controllerInfo['controllerName'];
        $controllerMethod = $controllerInfo['controllerMethod'];

        require_once(__DIR__ . "../../../controllers/$controllerName.php");

        $controllerName::$controllerMethod();
    }

}