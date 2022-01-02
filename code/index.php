<?php

declare(strict_types=1);

require_once(__DIR__ . "/app/utils/Router.php");

/**
 * Application routes
 */
Router::routeAdd('/', PageController::class, 'index');
Router::routeAdd('/api', PageController::class, 'api');

// ----------------------
Router::loadController();