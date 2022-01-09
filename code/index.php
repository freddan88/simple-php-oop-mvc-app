<?php

declare(strict_types=1);

require_once(__DIR__ . "/app/Router.php");
require_once(__DIR__ . "/app/security/Authorize.php");
require_once(__DIR__ . "/app/security/Authenticator.php");

// (www) get-routes
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
Router::postRoute('/api/signup', ApiController::class, 'signup');

/**
 * Supported http-methods and examples:
 * GET - Usage: getRoute('urlPath', classController, 'controllerMethod', 'controllerPath' Optional - Root = /controllers)
 * POST - Usage: postRoute('urlPath', classController, 'controllerMethod', 'controllerPath' Optional - Root = /controllers)
 */

// session_id($_POST['uuid']);
// session_start();

// $authorize = new Authorize();

// $authorize->route('/dashboard')->roles(['admin','user'])->validate();
// $authorize->route('/api')->roles(['admin','user'])->validate();

$authenticate = new Authenticator();

$wwwRoutes = ['/dashboard'];
$authenticate->routes($wwwRoutes)->debugRoutes();

$apiRoutes = ['/api/hej'];
$authenticate->routes($apiRoutes)->validateApiKey();

Router::loadController();