<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Arcanesoft\Foundation\Http\Routes;

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
        $router->group([
            'prefix'    => 'dashboard',
            'as'        => 'foundation::',
            'namespace' => 'Arcanesoft\\Foundation\\Http\\Controllers',
        ], function (Router $router) {
            (new Routes\DashboardRoute())->map($router);
        });
    }
}
