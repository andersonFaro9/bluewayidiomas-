<?php

namespace App\Http\Routing;

use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route as Facade;

/**
 * Class Router
 * @package App\Http\Routing
 */
class Router extends Facade
{
    /**
     * @param string $uri
     * @param string $controller
     */
    public static function api($uri, $controller)
    {
        static::get($uri, "{$controller}@search");
        static::post($uri, "{$controller}@create");
        static::get("{$uri}/{id}", "{$controller}@read");
        static::patch("{$uri}/{id}", "{$controller}@update");
        static::delete("{$uri}/{id}", "{$controller}@delete");
        static::patch("{$uri}/{id}/restore", "{$controller}@restore");
    }

    /**
     * @return RouteRegistrar
     */
    public static function restricted()
    {
        return static::middleware(['jwt.auth', 'jwt.refresh']);
    }
}