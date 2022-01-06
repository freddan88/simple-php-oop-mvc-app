<?php

declare(strict_types=1);

// session_start();

require_once(__DIR__ . "/app/Router.php");
require_once(__DIR__ . "/app/utils/ProtectRoute.php");

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
ProtectRoute::apiKey() && Router::getRoute('/api', ApiController::class, 'index');

/**
 * Supported http-methods and examples:
 * GET - Usage: getRoute('urlPath', classController, 'controllerMethod', 'controllerPath' Optional - Root = /controllers)
 * POST - Usage: postRoute('urlPath', classController, 'controllerMethod', 'controllerPath' Optional - Root = /controllers)
 */
Router::loadController();