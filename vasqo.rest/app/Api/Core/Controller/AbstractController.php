<?php


namespace Vasqo\Rest\Api\Core\Controller;


use Vasqo\Rest\Api\Core\Controller\Interfaces\ControllerInterface;
use Vasqo\Rest\Api\Core\Middleware\Interfaces\MiddlewareInterface;
use Vasqo\Rest\Api\Core\View\Interfaces\ViewInterface;
use Vasqo\Rest\Api\Core\View\JsonView;

abstract class AbstractController implements ControllerInterface
{
    /**
     * @var ViewInterface
     */
    protected ViewInterface $view;

    /**
     * AbstractController constructor.
     */
    public function __construct()
    {
        $this->view = new JsonView();
    }

    /**
     * @return mixed
     */
    abstract function index();

    /**
     * @param string $middlewarePath
     */
    protected function middleware(string $middlewarePath) : void
    {
        $middleware = new $middlewarePath();
        if ($middleware instanceof MiddlewareInterface) {
            $middleware->execute();
        }
    }
}