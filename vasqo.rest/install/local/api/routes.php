<?php

use Vasqo\Rest\Api\Controllers\PingController;
use Vasqo\Rest\Api\Core\Routes\Router;

Router::get("/ping", [PingController::class, "index"]);