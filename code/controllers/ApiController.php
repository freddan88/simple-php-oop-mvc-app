<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/security/Sanitize.php");
require_once(__DIR__ . "../../app/database/Query.php");
require_once(__DIR__ . "../../app/utils/Response.php");
require_once(__DIR__ . "../../app/utils/Errors.php");
require_once(__DIR__ . "../../models/User.php");

class ApiController {

    public function index()
    {
        $jsonData = [
            'Test' => 'Index',
            'method' => $_SERVER['REQUEST_METHOD'],
        ];
        Response::json($jsonData);
    } 

    public function hello()
    {
        $jsonData = [
            'Test' => 'Hello',
            'method' => $_SERVER['REQUEST_METHOD'],
        ];
        Response::json($jsonData);
    }

    public function signup()
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

        $sanitize = new Sanitize();

        $table = 'tbl_users';
        $fields = ['name', 'email', 'password', 'admin'];

        $sql = new Query($table);
        $sql = $sql->insert($fields)->append();

        $name = $sanitize->string($_POST[$fields[0]]);
        $email = $sanitize->email($_POST[$fields[1]]);

        $user = new User();
        $user->create($sql)
        ->add($fields[0], $name, PDO::PARAM_STR)
        ->add($fields[1], $email, PDO::PARAM_STR)
        ->add($fields[2], '123123', PDO::PARAM_STR)
        ->add($fields[3], 1, PDO::PARAM_INT)
        ->save();

        $jsonData = [
            'code' => 200,
            'success' => true,
            'method' => $_SERVER['REQUEST_METHOD'],
            'sql' => $sql,
        ];

        Response::json($jsonData);
    } 
}