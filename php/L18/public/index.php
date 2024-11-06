<?php

include_once '../vendor/autoload.php';

use l18\Entity\User;

$user = new User(
    'John Doe',
    'john@done.com',
    password_hash('password', PASSWORD_DEFAULT)
);

echo $user->getName() . PHP_EOL;