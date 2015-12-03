<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Support\Providers\RouteServiceProvider as ServiceProvider;
use Arcanesoft\Foundation\Http\Middleware;
use Arcanesoft\Foundation\Http\Routes;
use Illuminate\Routing\Router;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the routes namespace
     *
     * @return string
     */
    protected function getRouteNamespace()
    {
        return 'Arcanesoft\\Foundation\\Http\\Routes';
    }

    /**
     * Get Foundation route group.
     *
     * @return array
     */
    protected function getFoundationRouteGroup()
    {
        return config('arcanesoft.foundation.route', []);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Define the routes for the application.
     *
     * @param  Router $router
     */
    public function map(Router $router)
    {
        $this->registerMiddlewares();

        $router->group($this->getFoundationRouteGroup(), function (Router $router) {
            (new Routes\DashboardRoute())->map($router);
            (new Routes\LogViewerRoutes())->map($router);
        });
    }

    /**
     * Register all middlewares.
     */
    private function registerMiddlewares()
    {
        $this->middleware('admin', Middleware\AdminMiddleware::class);
    }
}
