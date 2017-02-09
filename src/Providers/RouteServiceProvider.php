<?php namespace Arcanesoft\Foundation\Providers;

use Arcanesoft\Core\Bases\RouteServiceProvider as ServiceProvider;
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
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapAdminRoutes();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Map the admin routes.
     */
    private function mapAdminRoutes()
    {
        $attributes = $this->getAdminAttributes(
            'foundation.',
            'Arcanesoft\\Foundation\\Http\\Controllers\\Admin'
        );

        $this->group($attributes, function () {
            Routes\Admin\DashboardRoute::register();
            Routes\Admin\SettingsRoutes::register();
            Routes\Admin\SystemRoutes::register();
        });
    }
}
