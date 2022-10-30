<?php


namespace Vasqo\Rest\Api\Core\Controller\Interfaces;


interface ControllerInterface
{
    /**
     * ControllerInterface constructor.
     */
    public function __construct();

    /**
     * @return mixed
     */
    public function index();
}