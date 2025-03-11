<?php

require_once __DIR__ . '/../vendor/autoload.php';

use pws\Hallo;
use Firebase\JWT\JWT;

//use vlado\Entity\Person;

$hallo = new Hallo();
//$person = new Person();

$hallo->print();
//echo $person->getFirstname();


$key = 'example_key';
$payload = [
    'iss' => 'http://example.org',
    'aud' => 'http://example.com',
    'iat' => 1356999524,
    'nbf' => 1357000000
];

$jwt = JWT::encode($payload, $key, 'HS256');
