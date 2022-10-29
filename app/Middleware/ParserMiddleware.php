<?php
namespace App\Middleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

/* Replacing the @APP_NAME@, @LANG@ and @CHARSET@ placeholders with the values from the .env file. */
class ParserMiddleware
{

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);
        $existingContent = (string) $response->getBody();
        $existingContent = str_replace('@APP_NAME@', $_ENV['APP_NAME'], $existingContent);
        $existingContent = str_replace('@LANG@', $_ENV['LANG'], $existingContent);
        $existingContent = str_replace('@CHARSET@', $_ENV['CHARSET'], $existingContent);
        $response = new Response();

        $response->getBody()->write($existingContent);

        return $response;
    }

}