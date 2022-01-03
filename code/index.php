<?php

declare(strict_types=1);

require_once(__DIR__ . "/app/utils/Router.php");
require_once(__DIR__ . "/app/utils/ApiRouter.php");

ApiRouter::getRoute('/', PageController::class, 'index');
ApiRouter::getRoute('/api', PageController::class, 'api');

ApiRouter::loadController();

/**
 * Application routes
 */
// Router::getRoute('/', PageController::class, 'index');
// Router::getRoute('/signup', PageController::class, 'signup');
// Router::postRoute('/hej', PageController::class, 'signup');
// Router::getRoute('/api', PageController::class, 'api');

// ----------------------
// Router::loadController();