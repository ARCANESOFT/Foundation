<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Support\ServiceProvider;

/**
 * Class     PackageServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PackageServiceProvider extends ServiceProvider
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
        $this->registerSettingsPackage();
        $this->registerHasherPackage();
        $this->registerBreadcrumbsPackage();
        $this->registerLogViewerPackage();
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
     |  Package Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the Settings Package.
     */
    private function registerSettingsPackage()
    {
        $this->app->register(\Arcanedev\Settings\SettingsServiceProvider::class);
        $this->alias('Setting', \Arcanedev\Settings\Facades\Setting::class);
    }

    /**
     * Register the Hasher Package.
     */
    private function registerHasherPackage()
    {
        $this->app->register(\Arcanedev\Hasher\HasherServiceProvider::class);
    }

    /**
     * Register the Breadcrumbs Package.
     */
    private function registerBreadcrumbsPackage()
    {
        $this->app->register(\Arcanedev\Breadcrumbs\BreadcrumbsServiceProvider::class);
    }

    /**
     * Register the LogViewer Package.
     */
    private function registerLogViewerPackage()
    {
        $this->app->register(\Arcanedev\LogViewer\LogViewerServiceProvider::class);

        // Setting up the LogViewer config.
        $this->app['config']->set('log-viewer.route.enabled', false);
        $this->app['config']->set(
            'log-viewer.menu.filter-route',
            'foundation::log-viewer.logs.filter'
        );
    }
}
