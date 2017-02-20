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
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */
    /**
     * The admin controller namespace for the application.
     *
     * @var string
     */
    protected $adminNamespace = 'Arcanesoft\\Foundation\\Http\\Controllers\\Admin';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapAdminRoutes();
    }

    /**
     * Map the admin routes.
     */
    private function mapAdminRoutes()
    {
        $this->adminGroup(function () {
            $this->name('foundation.')->group(function () {
                Routes\Admin\DashboardRoute::register();
                Routes\Admin\SettingsRoutes::register();
                Routes\Admin\SystemRoutes::register();
            });
        });
    }
}
