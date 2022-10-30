<?php


namespace Vasqo\Rest\Api\Core\Middleware\Interfaces;


interface MiddlewareInterface
{
    public function execute() : void;
}