<?php

namespace Vasqo\Rest\Api\Core\Routes;

use Vasqo\Rest\Api\Controllers\NotFoundController;
use Vasqo\Rest\Api\Core\View\JsonView;

class Router
{
    /**
     * @var array
     */
    protected static array $paths = [];

    /**
     * @param string $route
     */
    public static function startWithRoute(string $route): void
    {
        if (isset(self::$paths[$route])) {
            $currentPath = self::$paths[$route];

            if ($_SERVER['REQUEST_METHOD'] == $currentPath["method"]) {
                $controller = new $currentPath["controller"]();

                $actionName = $currentPath["action"];
                $response = $controller->$actionName();

                die($response);
            } else {
                self::pageNotFound();
            }
        } else {
            self::pageNotFound();
        }
    }

    /**
     *
     */
    /*public static function start() : void
    {
        $routes = self::cleanRoute();

        if (isset(self::$paths[$routes])) {
            $currentPath = self::$paths[$routes];

            if ($_SERVER['REQUEST_METHOD'] == $currentPath["method"]) {
                $controller = new $currentPath["controller"]();

                $actionName = $currentPath["action"];
                $controller->$actionName();
            }
            else {
                self::pageNotFound();
            }
        }
        else {
            self::pageNotFound();
        }
    }*/

    /**
     * @param string $path
     * @param array $controller
     */
    public static function get(string $path, array $controller): void
    {
        self::addPath($path, $controller, "GET");
    }

    /**
     * @param string $path
     * @param array $controller
     */
    public static function post(string $path, array $controller): void
    {
        self::addPath($path, $controller, "POST");
    }

    /**
     * @param string $path
     * @param array $controller
     */
    public static function delete(string $path, array $controller): void
    {
        self::addPath($path, $controller, "DELETE");
    }

    /**
     * @param string $path
     * @param array $controller
     */
    public static function put(string $path, array $controller): void
    {
        self::addPath($path, $controller, "PUT");
    }

    /**
     * @param string $path
     * @param array $controller
     * @param string $method
     */
    private static function addPath(string $path, array $controller, string $method) : void
    {
        if (mb_stripos($path, "/") == 0) $path = mb_substr($path, 1);

        if (!isset(self::$paths[$path])) {
            self::$paths[$path] = [
                "controller" => $controller[0],
                "action" => $controller[1] ?? "index",
                "method" => $method,
            ];
        }
    }

    /**
     * @return string
     */
    private static function cleanRoute() : string
    {
        return explode("?", $_SERVER['REQUEST_URI'])[0];
    }

    /**
     *
     */
    private static function pageNotFound() : void
    {
        die((new NotFoundController())->index());
    }
}