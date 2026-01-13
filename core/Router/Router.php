<?php

namespace Core\Router;

class Router
{
    public static array $routes = [];

    public static function get(string $path, array $action): Route
    {
        $route = new Route($path, $action);
        self::$routes['GET'] = $route;
        return $route;
    }

    public static function post(string $path, array $action):   Route
    {
        $route = new Route($path, $action);
        self::$routes['POST'] = $route;
        return $route;
    }

    public static function put(string $path, array $action): Route
    {
        $route = new Route($path, $action);
        self::$routes['PUT'] = $route;
        return $route;
    }

    public static function patch(string $path, array $action): Route
    {
        $route = new Route($path, $action);
        self::$routes['PATCH'] = $route;
        return $route;
    }

    public static function delete(string $path, array $action): Route
    {
        $route = new Route($path, $action);
        self::$routes['DELETE'] = $route;
        return $route;
    }
}