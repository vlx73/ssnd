<?php

use l19\Service\DbService;
use l19\Entity\User;

include_once '../vendor/autoload.php';

// Parametre pripojenia k DB
$host = $_ENV['POSTGRES_HOST'];
$port = '5432';
$dbname = $_ENV['APP_DB_NAME'];
$user = $_ENV['POSTGRES_USER'];
$password = $_ENV['POSTGRES_PASSWORD'];

// vytvorenie instancie triedy DbService
$dbService = new DbService($host, $port, $dbname, $user, $password);

// príklad query
$query = "SELECT * FROM ssnd_user";

// Execute the query
$result = $dbService->query($query);
//var_dump($result);
$users = [];

// Loop through the result set
foreach ($result as $row) {
    //var_dump($row);
    $user = new User($row['email'], $row['password']);
    $user->setFirstName($row['first_name']);
    $user->setLastName($row['last_name']);
    
    $users[] = $user;
}

// alternatíva s hydrátorom
// $userHydrate = new UserHydrator();
// foreach ($result as $row) {
//     $users[] = $userHydrate->hydrate($row);
// }

// vypis vysledkov
include 'template.php';