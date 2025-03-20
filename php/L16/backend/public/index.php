<?php

require __DIR__ . '/../vendor/autoload.php';

use pwa\Router\Router;
use pwa\Controller\PersonController;

//echo "Hello, world from L16!";

// 1. vytvoríme inštanciu routra
$router = new Router();

//// 2. nakonfigurujeme routy
$router->get('/persons', PersonController::class, 'read');
$router->post('/persons', PersonController::class, 'create');
$router->delete('/persons/{personId:UUID}', PersonController::class, 'delete');

// 3. zavoláme metódu dispatch na routri
$router->dispatch();
