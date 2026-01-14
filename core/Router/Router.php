<?php

namespace Core\Router;

class Router
{
    public static array $routes = [];

    public static function get(string $path, array $action): Route
    {
        return self::addRoute('GET', $path, $action);
    }

    public static function post(string $path, array $action): Route
    {
        return self::addRoute('POST', $path, $action);
    }

    public static function put(string $path, array $action): Route
    {
        return self::addRoute('PUT', $path, $action);
    }

    public static function patch(string $path, array $action): Route
    {
        return self::addRoute('PATCH', $path, $action);
    }

    public static function delete(string $path, array $action): Route
    {
        return self::addRoute('DELETE', $path, $action);
    }

    private static function addRoute(string $method, string $path, array $action): Route
    {
        $route = new Route($path, $action);
        self::$routes[$method][] = $route;
        return $route;
    }

    public static function resolve(string $method, string $path): ?Route
    {
        foreach (self::$routes[$method] ?? [] as $route) {
            if ($route->getPath() === $path) {
                return $route;
            }
        }

        return null;
    }
}