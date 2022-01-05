<?php

declare(strict_types=1);

require_once(__DIR__ . "/utils/Response.php");

class Router {

    const GET = 'GET';
    const PUT = 'PUT';
    const POST = 'POST';
    const DELETE = 'DELETE';

    private static $routesArray = [];

    private static function getControllerInfo($urlPath)
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case self::GET:
                $controllerInfo = Self::$routesArray[self::GET][$urlPath];
                break;
            case self::PUT:
                $controllerInfo = Self::$routesArray[self::PUT][$urlPath];
                break;
            case self::POST:
                $controllerInfo = Self::$routesArray[self::POST][$urlPath];
                break;
            case self::DELETE:
                $controllerInfo = Self::$routesArray[self::DELETE][$urlPath];
                break;
        }

        if (str_contains($urlPath, 'api') && !$controllerInfo) Response::json(['code' => 404, 'message' => 'Not found']);
        if (!$controllerInfo) Response::render('error', ['pageTitle' => '404', 'message' => 'Page not found']);

        return $controllerInfo;
    }

    private static function addRoute($requestMethod, $urlPath, $controller, $controllerMethod, $controllerPath)
    {
        Self::$routesArray[$requestMethod][$urlPath]['controllerName'] = $controller;
        Self::$routesArray[$requestMethod][$urlPath]['controllerPath'] = $controllerPath;
        Self::$routesArray[$requestMethod][$urlPath]['controllerMethod'] = $controllerMethod;
    }

    public static function getRoute($urlPath, $controller, $controllerMethod, $controllerPath = null)
    {
        Self::addRoute(self::GET, $urlPath, $controller, $controllerMethod, $controllerPath);
    }

    public static function putRoute($urlPath, $controller, $controllerMethod, $controllerPath = null)
    {
        Self::addRoute(self::PUT, $urlPath, $controller, $controllerMethod, $controllerPath);
    }

    public static function postRoute($urlPath, $controller, $controllerMethod, $controllerPath = null)
    {
        Self::addRoute(self::POST, $urlPath, $controller, $controllerMethod, $controllerPath);
    }

    public static function deleteRoute($urlPath, $controller, $controllerMethod, $controllerPath = null)
    {
        Self::addRoute(self::DELETE, $urlPath, $controller, $controllerMethod, $controllerPath);
    }

    public static function loadController()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $urlPath = parse_url($uri, PHP_URL_PATH);
        $urlPath = '/' . trim($urlPath,'/');

        $controllerInfo = Self::getControllerInfo($urlPath);
        $controllerName = $controllerInfo['controllerName'];
        $controllerPath = $controllerInfo['controllerPath'];
        $controllerMethod = $controllerInfo['controllerMethod'];

        $controllerPath = $controllerPath ? 'controllers/' . trim($controllerPath,'/') : 'controllers';
        require_once(__DIR__ . "../../$controllerPath/$controllerName.php");
        
        if (!method_exists($controllerName, $controllerMethod)) {
            if (str_contains($urlPath, 'api')) Response::json(['code' => 501, 'message' => 'Not Implemented']);
            Response::render('error', ['pageTitle' => '501', 'message' => 'Not Implemented']);
        }

        $controllerName::$controllerMethod();
    }
}