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

    public static function put()
    {
        parse_str(file_get_contents('php://input'), $_PUT);
        Response::json($_PUT);
    } 
}