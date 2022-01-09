<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/utils/Response.php");

class ApiController {

    public static function index()
    {
        $jsonData = [
            'Test' => 'Index',
            'method' => $_SERVER['REQUEST_METHOD'],
        ];
        Response::json($jsonData);
    } 

    public static function hello()
    {
        $jsonData = [
            'Test' => 'Hello',
            'method' => $_SERVER['REQUEST_METHOD'],
        ];
        Response::json($jsonData);
    }

    public static function signup()
    {
        $jsonData = [
            'code' => 200,
            'success' => true,
            'method' => $_SERVER['REQUEST_METHOD'],
            'postData' => $_POST,
        ];
        Response::json($jsonData);
    } 
}