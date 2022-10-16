<?php
error_reporting(0);

ini_set('display_errors', 0);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\Controllers\MainController;
use App\Handlers\ErrorRenderer;
use App\Middleware\ParserMiddleware;
use App\Engine;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;

require __DIR__ . '/../vendor/autoload.php';

session_start();
$dotenv = Dotenv\Dotenv::createImmutable('..');
$dotenv->load();

Carbon::setLocale($_ENV['LANG']);

/*
 * DB Config
 */
$capsule = new Capsule;

$capsule->addConnection([
    "driver" => $_ENV['DRIVER'],
    "host" => $_ENV['HOST'],
    "database" => $_ENV['DATABASE'],
    "username" => $_ENV['USERNAME'],
    "password" => $_ENV['PASSWORD']
]);
//Make this Capsule instance available globally.
$capsule->setAsGlobal();
// Setup the Eloquent ORM.
$capsule->bootEloquent();

/**
 * Instantiate App
 *
 * In order for the factory to work you need to ensure you have installed
 * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
 * ServerRequest creator (included with Slim PSR-7)
 */
$app = AppFactory::create();

$container = $app->getContainer();

$app->addRoutingMiddleware();

$app->add(new ParserMiddleware());

/**
 * Add Error Middleware
 *
 * @param bool                  $displayErrorDetails -> Should be set to false in production
 * @param bool                  $logErrors -> Parameter is passed to the default ErrorHandler
 * @param bool                  $logErrorDetails -> Display error details in error log
 * @param LoggerInterface|null  $logger -> Optional PSR-3 Logger
 *
 * Note: This middleware should be added last. It will not handle any exceptions/errors
 * for middleware added after it.
 */
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorHandler = $errorMiddleware->getDefaultErrorHandler();
$errorHandler->registerErrorRenderer('text/html', ErrorRenderer::class);

require 'routes.php';

$app->run();



// Run app
