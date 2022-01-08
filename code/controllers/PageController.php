<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/utils/Response.php");
require_once(__DIR__ . "../../models/User.php");

class PageController {

    public static function index()
    {
        $viewData = [
            'metaTitle' => 'Fredrik | Home',
            'metaDescription' => 'This is the home-page',
            'metaKeywords' => 'Home, Page',
            'metaAuthor' => 'Fredrik Leemann',
            'pageJavascriptFileNames' => ['home'],
            'pageStyleSheetFileNames' => ['home'],
            'pageHeading' => 'This is the home-page',
        ];
        $user = new User();
        Response::render('home', $viewData);
    }

    public static function login()
    {        
        $viewData = [
            'metaTitle' => 'Fredrik | Login',
            'metaDescription' => 'This is the login-page',
            'metaKeywords' => 'Login, Page',
            'metaAuthor' => 'Fredrik Leemann',
            'pageStyleSheetFileNames' => ['login'],
            'pageHeading' => 'This is the login-page',
            'pageMessage' => empty($_GET['message']) ? '' : urldecode($_GET['message']),
        ];
        // $_SESSION['isLogedin'] = true;
        Response::render('login', $viewData);
    }

    public static function signup()
    {        
        $viewData = [
            'metaTitle' => 'Fredrik | Signup',
            'metaDescription' => 'This is the signup-page',
            'metaKeywords' => 'Signup, Page',
            'metaAuthor' => 'Fredrik Leemann',
            'pageStyleSheetFileNames' => ['signup'],
            'pageHeading' => 'This is the signup-page',
        ];
        //session_destroy();
        Response::render('signup', $viewData);
    }
}