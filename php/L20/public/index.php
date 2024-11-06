<?php

use l20\Controller\UserController;
use l20\Enum\Email;
use l20\Exceptions\RouteNotFoundException;
use l20\Hydrator\UserHydrator;
use l20\Router\Router;
use l20\Service\DbService;
use l20\Entity\User;
use l20\Service\UserModel;

include_once '../vendor/autoload.php';

// Parametre pripojenia k DB


// Vytvoríme si router
$router = new Router();

// Nakonfigurjeme router
$router->get('/users', [UserController::class, 'showUsers']);

// volanie routeru
try {
    echo $router->resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
} catch (RouteNotFoundException $e) {
    http_response_code(404);
    include_once '404.php';
}

