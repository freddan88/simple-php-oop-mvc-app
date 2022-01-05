<?php

declare(strict_types=1);

require_once(__DIR__ . "/app/Router.php");

// (www) get-routes
Router::getRoute('/', PageController::class, 'index');
Router::getRoute('/login', PageController::class, 'login');
Router::getRoute('/signup', PageController::class, 'signup');

// (www) post-routes
Router::postRoute('/login', UserController::class, 'login');
Router::postRoute('/logout', UserController::class, 'signup');
Router::postRoute('/logout', UserController::class, 'logout');

// (api) get-routes
Router::getRoute('/api', ApiController::class, 'index');

/**
 * Supported http-methods and examples:
 * GET - Usage: getRoute('urlPath', classController, 'controllerMethod', 'controllerPath' Optional - Root = /controllers)
 * PUT - Usage: putRoute('urlPath', classController, 'controllerMethod', 'controllerPath' Optional - Root = /controllers)
 * POST - Usage: postRoute('urlPath', classController, 'controllerMethod', 'controllerPath' Optional - Root = /controllers)
 * DELETE - Usage: deleteRoute('urlPath', classController, 'controllerMethod', 'controllerPath' Optional - Root = /controllers)
 */
Router::loadController();