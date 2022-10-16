<?php

use App\Controllers\About;
use App\Controllers\MainController;
require '../vendor/autoload.php';

/* Creating an array of routes. */
$web = [
    '/' => [
        'method' => 'GET',
        'class' => [MainController::class, 'index'],
        'middleware' => null,
        'callback' => null
    ],
    '/about' => [
        'method' => 'GET',
        'class' => [About::class, 'index'],
        'middleware' => null,
        'callback' => null
    ],
    '/test' => [
        'method' => 'GET',
        'class' => [About::class, 'index'],
        'middleware' => null,
        'callback' => null
    ],
    '/kingunia' => [
        'method' => 'GET',
        'class' => [About::class, 'index'],
        'middleware' => null,
        'callback' => null
    ]

];