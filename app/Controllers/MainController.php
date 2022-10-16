<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\Test;
use Carbon\Carbon;
use Psr\Container\ContainerInterface;
use Illuminate\Database\Query\Builder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
    
class MainController extends Controller
{
    public function index(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {

        $start = Carbon::now();

        $end = Carbon::now()->subDay(5);
        
        $data = $start->diffForHumans($end);

        return $this->render($response, 'index.php', ['name' => $data]);
    }

    public function lipa(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        return $this->render($response, 'index.php', ['name' => 'Lipa']);
    }
}
        