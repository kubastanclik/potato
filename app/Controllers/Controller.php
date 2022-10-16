<?php

namespace App\Controllers;

use Slim\Views\PhpRenderer;
use App\Handlers\Engine;

class Controller
{
    private PhpRenderer $view;

    public function __construct()
    {
        $this->view = new PhpRenderer($_ENV['TEMPLATES']);

        return $this;
    }

    public function render($response, $template, array $args = [])
    {
        return $this->view->render($response, $template, $args);
    }

    public function checkAuth()
    {
        if (!isset($_SESSION['auth'])) {
            echo "NO AUTH";
        }
    }
}