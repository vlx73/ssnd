<?php

require __DIR__ . '/../vendor/autoload.php';

//echo "Hello, world from L15!";

// 1. vytvoríme inštanciu routra

// 2. nakonfigurujeme routy

// 3. zavoláme metódu dispatch na routri

header('Content-Type: application/json');

echo json_encode([
    'message' => 'Hello, world!',
]);