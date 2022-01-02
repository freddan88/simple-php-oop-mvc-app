<?php

declare(strict_types=1);

class Router {
    static $postRoutes = [];
    static $getRoutes = [
        'default' => [
            'controllerMethod' => 'default',
            'controllerName' => PageController::class,
        ]
    ];

    private static function getControllerInfo($path)
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $controllerInfo = self::$getRoutes[$path];
                break;
            case 'POST':
                $controllerInfo = self::$postRoutes[$path];
                break;
        }

        if (!$controllerInfo) return self::$getRoutes['default'];

        return $controllerInfo;
    }

    public static function getRoute($path, $controller, $method)
    {
        self::$getRoutes[$path]['controllerMethod'] = $method;
        self::$getRoutes[$path]['controllerName'] = $controller;
    }

    public static function postRoute($path, $controller, $method)
    {
        self::$postRoutes[$path]['controllerMethod'] = $method;
        self::$postRoutes[$path]['controllerName'] = $controller;
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