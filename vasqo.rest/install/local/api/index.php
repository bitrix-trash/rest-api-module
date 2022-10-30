<?php

use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Vasqo\Rest\Api\Core\Routes\Router;

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
Loader::includeModule("vasqo.rest");

require "./routes.php";

$request = Context::getCurrent()->getRequest();
$route = $request->get("route");

if ($route) Router::startWithRoute($request->get("route"));
