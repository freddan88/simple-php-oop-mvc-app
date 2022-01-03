<?php

declare(strict_types=1);

class ApiRouter {

    const GET = 'GET';
    const PUT = 'PUT';
    const POST = 'POST';
    const DELETE = 'DELETE';

    private static $routesArray = [
        'default' => [
            'controllerName' => NotFoundController::class,
            'controllerMethod' => 'jsonResponse',
        ]
    ];

    private static function getControllerInfo($path)
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case self::GET:
                $controllerInfo = Self::$routesArray[self::GET][$path];
                break;
            case self::PUT:
                $controllerInfo = Self::$routesArray[self::PUT][$path];
                break;
            case self::POST:
                $controllerInfo = Self::$routesArray[self::POST][$path];
                break;
            case self::DELETE:
                $controllerInfo = Self::$routesArray[self::DELETE][$path];
                break;
        }

        if (!$controllerInfo) return Self::$routesArray['default'];

        return $controllerInfo;
    }

    private static function addRoute($requestMethod, $path, $controller, $controllerMethod)
    {
        Self::$routesArray[$requestMethod][$path]['controllerName'] = $controller;
        Self::$routesArray[$requestMethod][$path]['controllerMethod'] = $controllerMethod;
    }

    public static function getRoute($path, $controller, $controllerMethod)
    {
        Self::addRoute(self::GET, $path, $controller, $controllerMethod);
    }

    public static function putRoute($path, $controller, $controllerMethod)
    {
        Self::addRoute(self::PUT, $path, $controller, $controllerMethod);
    }

    public static function postRoute($path, $controller, $controllerMethod)
    {
        Self::addRoute(self::POST, $path, $controller, $controllerMethod);
    }

    public static function deleteRoute($path, $controller, $controllerMethod)
    {
        Self::addRoute(self::DELETE, $path, $controller, $controllerMethod);
    }

    public static function loadController()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $path = parse_url($uri, PHP_URL_PATH);

        $controllerInfo = Self::getControllerInfo($path);
        $controllerName = $controllerInfo['controllerName'];
        $controllerMethod = $controllerInfo['controllerMethod'];

        require_once(__DIR__ . "../../../controllers/$controllerName.php");

        if (!method_exists($controllerName, $controllerMethod)) {
            // die(var_dump('Method not found'));
            echo json_encode([]);
            exit;
        }

        $controllerName::$controllerMethod();
    }

}