<?php

declare(strict_types=1);

// Authentication is the process of verifying who someone is
// Authorization is the process of verifying what specific applications, files, and data a user has access to.

class Security {

    public function authenticated($path)
    {
        $uri = $_SERVER['REQUEST_URI'];
        $urlPath = parse_url($uri, PHP_URL_PATH);
        $urlPath = '/' . trim($urlPath,'/');
        if ($urlPath !== $path) return true;
        if (isset($_SESSION['isLogedin']) && $_SESSION['isLogedin']) return true;
        return false;
    }

    public function authorized()
    {
        return false;
    }
}