<?php
namespace App\Controllers;
use App\Controllers\Controller;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
    
/* Extending the Controller class. */
class MainController extends Controller
{
    /**
     * > This function is called when the user visits the root of the website
     *
     * @param ServerRequestInterface request The request object.
     * @param ResponseInterface response The response object that will be returned to the client.
     *
     * @return The response object with the rendered template.
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response) {
        return $this->render($response, 'index.php');
    }
}
        