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

// class ProtectRoute {

//     public static function isLogedin($path)
//     {
//         $uri = $_SERVER['REQUEST_URI'];
//         $urlPath = parse_url($uri, PHP_URL_PATH);
//         $urlPath = '/' . trim($urlPath,'/');
//         if ($urlPath !== $path) return true;
//         if (isset($_SESSION['isLogedin']) && $_SESSION['isLogedin']) return true;
//         return false;
//     }

//     public static function bearer()
//     {
//         if (empty($_SERVER['HTTP_AUTHORIZATION'])) return false;
//         $bearerAuthString = $_SERVER['HTTP_AUTHORIZATION'];
//         $bearerAuth = explode(' ', $bearerAuthString);
//         if ($bearerAuth[0] !== 'Bearer') return false;
//         if ($bearerAuth[1] === '123') return true;
//         return false;
//     }

//     public static function apiKey()
//     {
//         if (empty($_GET['key'])) return false;
//         if ($_GET['key'] === '123') return true;
//         return false;
//     }
// }

// Authentication is the process of verifying who someone is
// Authorization is the process of verifying what specific applications, files, and data a user has access to.

// class Security {

//     public function authenticated($path)
//     {
//         $uri = $_SERVER['REQUEST_URI'];
//         $urlPath = parse_url($uri, PHP_URL_PATH);
//         $urlPath = '/' . trim($urlPath,'/');
//         if ($urlPath !== $path) return true;
//         if (isset($_SESSION['isLogedin']) && $_SESSION['isLogedin']) return true;
//         return false;
//     }

//     public function authorized()
//     {
//         return false;
//     }
// }