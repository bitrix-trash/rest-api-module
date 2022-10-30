<?php


namespace Vasqo\Rest\Api\Controllers;


use Vasqo\Rest\Api\Core\Controller\AbstractController;

class NotFoundController extends AbstractController
{
    /**
     * @return mixed|string
     */
    public function index()
    {
        return $this->view->error([], "Not found");
    }
}