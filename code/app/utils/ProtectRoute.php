<?php

declare(strict_types=1);

require_once(__DIR__ . "/Response.php");

class ProtectRoute {

    public static function isLogedin($path)
    {
        $uri = $_SERVER['REQUEST_URI'];
        $urlPath = parse_url($uri, PHP_URL_PATH);
        $urlPath = '/' . trim($urlPath,'/');
        if ($urlPath !== $path) return true;
        if (isset($_SESSION['isLogedin']) && $_SESSION['isLogedin']) return true;
        return false;
    }

    public static function bearer()
    {
        if (empty($_SERVER['HTTP_AUTHORIZATION'])) return false;
        $bearerAuthString = $_SERVER['HTTP_AUTHORIZATION'];
        $bearerAuth = explode(' ', $bearerAuthString);
        if ($bearerAuth[0] !== 'Bearer') return false;
        if ($bearerAuth[1] === '123') return true;
        return false;
    }

    public static function apiKey()
    {
        if (empty($_GET['key'])) return false;
        if ($_GET['key'] === '123') return true;
        return false;
    }
}