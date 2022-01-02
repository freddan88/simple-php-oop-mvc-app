<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/utils/Response.php");

class PageController {

    public static function index()
    {
        $viewData = [
            'pageTitle' => 'Home',
            'heading' => 'This is the homepage'
        ];
        Response::render('index', $viewData);
    }

    public static function signup()
    {
        Response::render('signup');
    }

    public static function api()
    {
        $jsonData = [
            'Test' => 'Hello',
            'method' => $_SERVER['REQUEST_METHOD'],
        ];
        Response::json($jsonData);
    }

    public static function default()
    {
        echo '404 Not Found';
    }
}