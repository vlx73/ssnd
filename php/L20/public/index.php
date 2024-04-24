<?php

use l20\Hydrator\UserHydrator;
use l20\Service\DbService;
use l20\Entity\User;

include_once '../vendor/autoload.php';

// Parametre pripojenia k DB
$host = $_ENV['POSTGRES_HOST'];
$port = '5432';
$dbname = $_ENV['APP_DB_NAME'];
$user = $_ENV['POSTGRES_USER'];
$password = $_ENV['POSTGRES_PASSWORD'];

// vytvorenie instancie triedy UserService
$userService = new \l20\Service\UserService(
    new DbService($host, $port, $dbname, $user, $password)
);

$users = $userSersvice->getAll();

// vypis vysledkov
include 'template.php';