<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Support\ServiceProvider;

/**
 * Class     PackagesServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PackagesServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerLogViewerPackage();
        $this->registerRoutesViewerService();
        $this->registerAliases();
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'arcanedev.foundation.routes-viewer',
        ];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Register Services
     | ------------------------------------------------------------------------------------------------
     */
    public function registerRoutesViewerService()
    {
        $this->singleton(
            'arcanedev.foundation.routes-viewer',
            \Arcanesoft\Foundation\Services\RoutesViewer::class
        );
    }

    /* ------------------------------------------------------------------------------------------------
     |  Register Packages
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the LogViewer Package.
     */
    private function registerLogViewerPackage()
    {
        $this->registerProvider(\Arcanedev\LogViewer\LogViewerServiceProvider::class);

        $config = $this->config();

        // Setting up the LogViewer config.
        $config->set('log-viewer.route.enabled', false);
        $config->set(
            'log-viewer.menu.filter-route',
            $config->get('arcanesoft.foundation.log-viewer.filter-route')
        );
    }
}
