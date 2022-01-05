<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/utils/Response.php");

class UserController {

    public static function login()
    {
        Response::redirect('/');
    }

    public static function signup()
    {
        Response::redirect('/');
    }

    public static function logout()
    {
        Response::redirect('/');
    }
}