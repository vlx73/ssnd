<?php

$mojeIndexovePole = [];

// indexové pole

$person = [
    'meno'       => 'Janko',
    'priezvisko' => 'Hraško',
];


$mojeIndexovePole = [
    'jedna',
    'dva',
    'tri',
    'štyri',
];

// asociatívne pole
$mojeAsociativnePole = [
    [
        'meno'       => 'Janko',
        'priezvisko' => 'Hraško',
        'vek'        => 25,
        'pohlavie'   => 'muž',
    ],
    [
        'meno'       => 'Ferko',
        'priezvisko' => 'Hraško',
        'vek'        => 21,
        'pohlavie'   => 'muž',
    ],
    [
        'meno'       => 'Jo6ko',
        'priezvisko' => 'Hraško',
        'vek'        => 23,
        'pohlavie'   => 'muž',
    ],
];

var_dump($_SERVER);
/*
$_SERVER
$_POST
$_SERVER
$_REQUEST
$_GET
$_POST
$_FILES
$_ENV
$_COOKIE
$_SESSION
$GLOBALS
*/

//foreach ($mojeAsociativnePole as $key => $person) {
//    echo $key .' ' . $person['meno'] . '<br>';
//}


//
//var_dump($mojeAsociativnePole);
//
//echo '<h1>' . $mojeIndexovePole[0] . '</h1>';
//
//$a = 5;
//echo $a;
//echo '<h1>PHP</h1>';
//echo '<h2>' . 'Hello world!' . '</h2>';

//var_dump($_SERVER);


//require __DIR__ . '/User.php';
//
//$user = new User();
//
//$theContent = '<h1>' . $user->name . '</h1>';
//
//include_once __DIR__ . '/template.php';