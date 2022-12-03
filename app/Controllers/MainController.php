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
     * @throws \Throwable
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->render($response, 'index.php');
    }
}
        