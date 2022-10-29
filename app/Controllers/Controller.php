<?php

namespace App\Controllers;

use Slim\Psr7\Response;
use Slim\Views\PhpRenderer;
use App\Handlers\Engine;

/* A base class for all controllers. */
class Controller
{
    private PhpRenderer $view;
    private Response $response;

    /**
     * > This function creates a new instance of the PhpRenderer class, which is a class that renders PHP templates
     *
     * @return The object itself.
     */
    public function __construct()
    {
        $this->view = new PhpRenderer($_ENV['TEMPLATES']);
        $this->response = new Response();

        return $this;
    }

    /**
     * It renders a template with the given arguments
     *
     * @param response The response object that will be returned to the client.
     * @param template The name of the template to render.
     * @param array args An array of variables to pass to the template.
     *
     * @return \Psr\Http\Message\ResponseInterface view is being rendered.
     * @throws \Throwable
     */
    public function render($response, $template, array $args = [])
    {
        return $this->view->render($response, $template, $args);
    }
}