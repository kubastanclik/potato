<?php
error_reporting(0);

ini_set('display_errors', 0);

use App\Middleware\Auth;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\Controllers\MainController;
use App\Handlers\ErrorRenderer;
use App\Middleware\ParserMiddleware;
use App\Engine;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;


if (!empty($app)) {
    $app->get('/', [MainController::class, 'index']);
}