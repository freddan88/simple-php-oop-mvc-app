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
 * Supported http-methods:
 * GET (getRoute)
 * PUT (putRoute)
 * POST (postRoute)
 * DELETE (deleteRoute)
 */
Router::loadController();