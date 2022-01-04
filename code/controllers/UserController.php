<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/utils/Response.php");

class UserController {

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

    public static function signin()
    {
        Response::render('signup');
    }
}