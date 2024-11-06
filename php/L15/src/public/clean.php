<?php

header('Content-Type: application/json; charset=utf-8');

/*
$data = [
    'title'       => 'PHP',
    'description' => 'PHP is a popular general-purpose scripting language that is especially suited to web development.',
    'features'    => [
        'Fast',
        'Flexible',
        'Pragmatic',
        'Open source',
    ],
    'links'       => [
        'website' => 'https://www.php.net',
    ],
];*/

$data = [
    'posts' => [
        ['title' => 'Hello world!', 'content' => 'Welcome to PHP'],
        ['title' => 'Installation', 'content' => 'You can install PHP from https://www.php.net'],
        ['title' => 'Frameworks', 'content' => 'PHP has many frameworks, like Laravel, Symfony, and Slim'],
        ['title' => 'Open source', 'content' => 'PHP is open source'],
        ['title' => 'Documentation', 'content' => 'You can find the PHP documentation at https://www.php.net/docs.php'],
    ],
];

echo json_encode($data);
