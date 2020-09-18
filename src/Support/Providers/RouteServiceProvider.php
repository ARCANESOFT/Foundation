<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Providers;

use Arcanedev\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class     RouteServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class RouteServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Getters
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
            //
        ];
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        $routes = $this->routeClasses();

        static::bindRouteClasses($routes);

        $this->routes(function () use ($routes) {
            static::mapRouteClasses($routes);
        });
    }
}
