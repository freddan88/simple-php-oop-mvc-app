<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/utils/Response.php");

class PageController {

    public function index()
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
        Response::render('home', $viewData);
    }

    public function login()
    {        
        $viewData = [
            'metaTitle' => 'Fredrik | Login',
            'metaDescription' => 'This is the login-page',
            'metaKeywords' => 'Login, Page',
            'metaAuthor' => 'Fredrik Leemann',
            'pageStyleSheetFileNames' => ['form'],
            'pageHeading' => 'This is the login-page',
            'pageMessage' => empty($_GET['message']) ? '' : urldecode($_GET['message']),
        ];
        Response::render('login', $viewData);
    }

    public function signup()
    {        
        $viewData = [
            'metaTitle' => 'Fredrik | Signup',
            'metaDescription' => 'This is the signup-page',
            'metaKeywords' => 'Signup, Page',
            'metaAuthor' => 'Fredrik Leemann',
            'pageJavascriptFileNames' => ['signup'],
            'pageStyleSheetFileNames' => ['form'],
            'pageHeading' => 'This is the signup-page',
        ];
        Response::render('signup', $viewData);
    }
}