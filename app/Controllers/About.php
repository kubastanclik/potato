<?php
namespace App\Controllers;
use App\Controllers\Controller;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
    
class About extends Controller
{
    public function index(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        return $this->render($response, 'index.php', ['name' => 'Kingunia']);
    }
}
        