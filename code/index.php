<?php

declare(strict_types=1);

// session_start();

require_once(__DIR__ . "/app/Router.php");
require_once(__DIR__ . "/app/security/Authorize.php");
require_once(__DIR__ . "/app/security/Authenticator.php");

// (www) get-routes
// ProtectRoute::isLogedin('/') && 
Router::getRoute('/', PageController::class, 'index');
Router::getRoute('/login', PageController::class, 'login');
Router::getRoute('/signup', PageController::class, 'signup');
Router::getRoute('/dashboard', PageController::class, 'dashboard');

// (www) post-routes
Router::postRoute('/login', UserController::class, 'login');
Router::postRoute('/signup', UserController::class, 'signup');
Router::postRoute('/logout', UserController::class, 'logout');

// (api) get-routes
Router::getRoute('/api', ApiController::class, 'index');
Router::getRoute('/api/hej', ApiController::class, 'hello');

/**
 * Supported http-methods and examples:
 * GET - Usage: getRoute('urlPath', classController, 'controllerMethod', 'controllerPath' Optional - Root = /controllers)
 * POST - Usage: postRoute('urlPath', classController, 'controllerMethod', 'controllerPath' Optional - Root = /controllers)
 */

$authorize = new Authorize();

$authorize->setRoute('/dashboard', ['admin','user']);
$authorize->setRoute('/api', ['admin'])->validateAuthorization();

$authenticator = new Authenticator();

$wwwRoutes = ['/dashboard'];
$authenticator->setRoutes($wwwRoutes)->validateLogin();

$apiRoutes = ['/api'];
$authenticator->setRoutes($apiRoutes)->validateApiKey();

Router::loadController();