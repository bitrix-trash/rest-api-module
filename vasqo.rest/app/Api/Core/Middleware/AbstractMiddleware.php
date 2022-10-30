<?php


namespace Vasqo\Rest\Api\Core\Middleware;


use Vasqo\Rest\Api\Core\Middleware\Interfaces\MiddlewareInterface;

abstract class AbstractMiddleware implements MiddlewareInterface
{
    abstract public function execute(): void;

    /**
     * @param string $to
     */
    protected function redirect(string $to) : void
    {
        LocalRedirect($to);
    }
}