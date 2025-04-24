<?php

require __DIR__ . '/../vendor/autoload.php';

use pwa\Controller\AuthController;
use pwa\Router\Router;
use pwa\Controller\PersonController;
use pwa\Controller\HomePageController;

//echo "Hello, world from L17!";

// 1. vytvoríme inštanciu routra
$router = new Router();

// 2. nakonfigurujeme routy
// User management endpoints

$router->get('/',HomePageController::class, 'index');

// 3. zavoláme metódu dispatch na routri
$router->dispatch();
