<?php


namespace Vasqo\Rest\Api\Controllers;


use Vasqo\Rest\Api\Core\Controller\AbstractController;

class PingController extends AbstractController
{
    /**
     * @return mixed|void
     */
    function index()
    {
        return $this->view->success([], "good");
    }
}