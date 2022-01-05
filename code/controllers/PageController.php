<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/utils/Response.php");

class PageController {

    public static function index()
    {
        $viewData = [
            'pageTitle' => 'Home',
            'heading' => 'This is the home-page',
        ];
        Response::render('home', $viewData);
    }

    public static function login()
    {        
        $viewData = [
            'pageTitle' => 'Login',
            'heading' => 'This is the login-page',
            'message' => empty($_GET['message']) ? '' : urldecode($_GET['message']),
        ];
        Response::render('login', $viewData);
    }

    public static function signup()
    {        
        $viewData = [
            'pageTitle' => 'Signup',
            'heading' => 'This is the signup-page'
        ];
        Response::render('signup', $viewData);
    }
}