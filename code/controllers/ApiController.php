<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/utils/Response.php");

class ApiController {

    public static function index()
    {
        $jsonData = [
            'Test' => 'Hello',
            'method' => $_SERVER['REQUEST_METHOD'],
        ];
        Response::json($jsonData);
    } 
}