<?php

require __DIR__ .'/../routes/web.php';
require __DIR__ .'/../routes/api.php';

/*
 * Init web routes
 */
foreach (array_keys($web) as $w) {
    if ($web[$w]['method'] === 'GET') {
        $app->get($w, $web[$w]['class']);
    }
}

/*
 *  Init API routes
 */
foreach (array_keys($api) as $a) {
    if ($api[$a]['method'] === 'GET') {
        $app->get($a, $api[$a]['class']);
    }
}