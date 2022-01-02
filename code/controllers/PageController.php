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

    public static function api()
    {
        $jsonData = [
            'Test' => 'Hello',
        ];
        Response::json($jsonData);
    }

    public static function default()
    {
        echo '404 Not Found';
    }
}