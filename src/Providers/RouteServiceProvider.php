<?php namespace Arcanesoft\Foundation\Providers;

use Arcanesoft\Core\Bases\RouteServiceProvider as ServiceProvider;
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
        $router->group($this->getFoundationRouteGroup(), function (Router $router) {
            (new Routes\DashboardRoute)->map($router);
            (new Routes\LogViewerRoutes)->map($router);
            (new Routes\SettingsRoutes)->map($router);
        });
    }
}
