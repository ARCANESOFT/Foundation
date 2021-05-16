<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Providers;

use Arcanesoft\Foundation\Core\Http\Routes;
use Arcanesoft\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class     RouteServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the registered routes.
     *
     * @return array
     */
    public function routeClasses(): array
    {
        return [
            Routes\WebRoutes::class,
            Routes\ApiRoutes::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        parent::boot();

        $this->registerMiddleware($this->app['router']);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register middleware classes.
     *
     * @param  \Illuminate\Routing\Router  $router
     */
    private function registerMiddleware($router)
    {
        foreach ((array) $this->config('http.middleware') as $group => $middleware) {
            $router->pushMiddlewareToGroup($group, $middleware);
        }

        foreach ((array) $this->config('http.middleware-group') as $group => $middleware) {
            $router->middlewareGroup($group, $middleware);
        }
    }

    /**
     * Get the config.
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    private function config(string $key, $default = null)
    {
        return $this->app['config']->get("arcanesoft.foundation.{$key}", $default);
    }
}
