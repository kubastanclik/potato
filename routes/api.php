<?php

use App\Controllers\About;
use App\Controllers\MainController;
require '../vendor/autoload.php';

/* Creating an array of routes. */
$api = [
    '/lipa' => [
        'method' => 'GET',
        'class' => [MainController::class, 'lipa'],
        'middleware' => null,
        'callback' => null
    ]
];