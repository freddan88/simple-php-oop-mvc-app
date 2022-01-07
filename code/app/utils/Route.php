<?php

declare(strict_types=1);

trait Route {

    public function getCurrentRoute() {
        $uri = $_SERVER['REQUEST_URI'];
        $urlPath = parse_url($uri, PHP_URL_PATH);
        $urlPath = '/' . trim($urlPath,'/');
        return $urlPath;
    }
}