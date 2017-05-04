<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

class BaseController
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var PhpRenderer
     */
    protected $renderer;

    /**
     * @param Request  $request  (default: null)
     * @param Response $response (default: null)
     * @param PhpRenderer $renderer (default: null)
     */
    public function __construct(
        Request $request = null,
        Response $response = null,
        PhpRenderer $renderer = null
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param Response $response
     * @return $this
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return PhpRenderer
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * @param PhpRenderer $renderer
     * @return $this
     */
    public function setRenderer(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }
}
