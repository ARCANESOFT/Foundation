<?php namespace Arcanesoft\Foundation\Services;

use Illuminate\Contracts\Routing\Registrar as RouterContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class     RoutesViewer
 *
 * @package  Arcanesoft\Foundation\Services
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoutesViewer
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var \Illuminate\Routing\Router */
    protected $router;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct(RouterContract $router)
    {
        $this->router = $router;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the route collection.
     *
     * @return \Illuminate\Routing\RouteCollection
     */
    public function getRoutes()
    {
        return $this->router->getRoutes();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function all()
    {
        $routes = collect($this->getRoutes()->getRoutes());

        return $routes->filter(function (\Illuminate\Routing\Route $route) {
            return ! Str::startsWith($route->uri(), config('arcanesoft.foundation.routes-viewer.uris.hide', []));
        })->transform(function (\Illuminate\Routing\Route $route) {
            return [
                'methods'     => $this->prepareMethods($route),
                'domain'      => $route->domain(),
                'uri'         => $route->uri(),
                'name'        => $route->getName(),
                'action'      => $route->getActionName(),
                'middlewares' => $this->prepareMiddlewares($route),
            ];
        });
    }

    private function prepareMethods(\Illuminate\Routing\Route $route)
    {
        $methods = array_diff(
            $route->getMethods(),
            config('arcanesoft.foundation.routes-viewer.methods.hide', ['HEAD'])
        );
        $colors  = config('arcanesoft.foundation.routes-viewer.methods.colors', [
            'GET'    => 'success',
            'HEAD'   => 'default',
            'POST'   => 'primary',
            'PUT'    => 'warning',
            'PATCH'  => 'info',
            'DELETE' => 'danger',
        ]);

        return array_map(function ($method) use ($colors) {
            return [
                'name'  => $method,
                'color' => Arr::get($colors, $method),
            ];
        }, $methods);
    }

    private function prepareMiddlewares(\Illuminate\Routing\Route $route)
    {
        /** @var array $middleware */
        $middleware = $route->middleware();

        return method_exists($route, 'controllerMiddleware')
            ? array_merge($middleware, $route->controllerMiddleware())
            : $middleware;
    }
}
