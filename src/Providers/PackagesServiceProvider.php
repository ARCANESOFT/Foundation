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
        $this->configLogViewerPackage();
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
            //
        ];
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
        $this->app->register(\Arcanedev\LogViewer\LogViewerServiceProvider::class);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Config Packages
     | ------------------------------------------------------------------------------------------------
     */
    private function configLogViewerPackage()
    {
        $config = $this->config();

        // Setting up the LogViewer config.
        $config ->set('log-viewer.route.enabled', false);
        $config ->set(
            'log-viewer.menu.filter-route',
            'foundation::log-viewer.logs.filter'
        );
    }
}
