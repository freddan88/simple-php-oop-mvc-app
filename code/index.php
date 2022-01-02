<?php

declare(strict_types=1);

require_once(__DIR__ . "/app/utils/Router.php");

/**
 * Application routes
 */
Router::getRoute('/', PageController::class, 'index');
Router::getRoute('/signup', PageController::class, 'signup');
Router::postRoute('/hej', PageController::class, 'signup');
Router::getRoute('/api', PageController::class, 'api');

// ----------------------
Router::loadController();