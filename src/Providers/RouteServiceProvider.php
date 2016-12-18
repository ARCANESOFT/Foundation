<?php namespace Arcanesoft\Foundation\Providers;

use Arcanesoft\Core\Bases\RouteServiceProvider as ServiceProvider;
use Arcanesoft\Foundation\Http\Routes;
use Illuminate\Contracts\Routing\Registrar as Router;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     */
    public function map(Router $router)
    {
        $this->mapAdminRoutes($router);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Map the admin routes.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     */
    private function mapAdminRoutes(Router $router)
    {
        $attributes = array_merge($this->getFoundationRouteGroup(), [
            'as'        => 'admin::foundation.',
            'namespace' => 'Arcanesoft\\Foundation\\Http\\Controllers\\Admin',
        ]);

        $router->group($attributes, function (Router $router) {
            Routes\Admin\DashboardRoute::register($router);
            Routes\Admin\SettingsRoutes::register($router);
            Routes\Admin\SystemRoutes::register($router);
        });
    }
}
