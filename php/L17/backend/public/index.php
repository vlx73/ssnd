<?php

require __DIR__ . '/../vendor/autoload.php';

use pwa\Controller\AuthController;
use pwa\Router\Router;
use pwa\Controller\PersonController;

#echo "Hello, world from L17!";

// 1. vytvoríme inštanciu routra
$router = new Router();

// 2. nakonfigurujeme routy
// User management endpoints
$router->post('/users', AuthController::class, 'create');
$router->delete('/users/{userId:uuid}', AuthController::class, 'delete');

// Person endpoints
$router->get('/persons', PersonController::class, 'read');
$router->post('/persons', PersonController::class, 'create');
$router->delete('/persons/{personId:uuid}', PersonController::class, 'delete');

// 3. zavoláme metódu dispatch na routri
$router->dispatch();
