<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\LogViewer\LogViewerServiceProvider;
use Arcanedev\RouteViewer\RouteViewerServiceProvider;
use Arcanedev\Support\ServiceProvider;
use Spatie\Backup\BackupServiceProvider;

/**
 * Class     PackagesServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PackagesServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register()
    {
        parent::register();

        $this->registerLogViewerPackage();
        $this->registerRouteViewerPackage();
        $this->registerBackupsPackage();
        $this->registerAliases();
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            //
        ];
    }

    /* -----------------------------------------------------------------
     |  Register Packages
     | -----------------------------------------------------------------
     */
    /**
     * Register the LogViewer Package.
     */
    private function registerLogViewerPackage()
    {
        $this->registerProvider(LogViewerServiceProvider::class);

        $config = $this->config();

        // Setting up the LogViewer config.
        $config->set('log-viewer.route.enabled', false);
        $config->set(
            'log-viewer.menu.filter-route',
            $config->get('arcanesoft.foundation.log-viewer.filter-route')
        );
    }

    /**
     * Register the RouteViewer Package.
     */
    private function registerRouteViewerPackage()
    {
        $this->registerProvider(RouteViewerServiceProvider::class);

        // Setting up the RouteViewer config.
        $this->config()->set('route-viewer.php.route.enabled', false);
    }

    /**
     * Register the Backup package.
     */
    private function registerBackupsPackage()
    {
        $this->registerProvider(BackupServiceProvider::class);
    }
}
