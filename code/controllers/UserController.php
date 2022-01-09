<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/utils/Response.php");

class UserController {

    public function login()
    {
        if (empty($_POST['username'])) Response::redirect('/login');
        $message = urlencode('User successfully created');
        Response::redirect("/login?message=$message");
    }

    public function signup()
    {
        Response::redirect('/');
    }

    public function logout()
    {
        Response::redirect('/');
    }
}