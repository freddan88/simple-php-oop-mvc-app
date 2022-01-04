<?php

declare(strict_types=1);

require_once(__DIR__ . "/app/Router.php");

// www-routes
Router::getRoute('/', PageController::class, 'index');
Router::getRoute('/signup', PageController::class, 'signup');

// api-routes
Router::getRoute('/api', PageController::class, 'api');

// initialize
Router::loadController();