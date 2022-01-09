<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/database/Database.php");
require_once(__DIR__ . "../../app/utils/Response.php");
require_once(__DIR__ . "../../app/utils/Errors.php");
require_once(__DIR__ . "../../models/User.php");

class ApiController {
    use Database;

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
        if (empty($_POST['email'])) Errors::addField('Email is missing', 'email');
        if (empty($_POST['password'])) Errors::addField('Password is missing', 'password');
        if (empty($_POST['confirm_password'])) Errors::addField('Confirm password is missing', 'confirm_password');
        
        if (Errors::fields()) Response::json(Errors::getFields());

        if ($_POST['password'] !== $_POST['confirm_password'] ) {
            Errors::addField('Passwords do not match', 'password');
            Errors::addField('Passwords do not match', 'confirm_password');
        }
        
        if (Errors::fields()) Response::json(Errors::getFields());

        $databaseTable = 'tbl_users';
        $databaseTableFields = ['name', 'email', 'password', 'admin'];
        $user = new User($_POST, $databaseTable, $databaseTableFields);
        $user->create()->save();

        $jsonData = [
            'code' => 200,
            'success' => true,
            'method' => $_SERVER['REQUEST_METHOD'],
        ];
        Response::json($jsonData);
    } 
}