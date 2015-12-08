<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Breadcrumbs\BreadcrumbsServiceProvider;
use Arcanedev\Hasher\HasherServiceProvider;
use Arcanedev\LogViewer\LogViewerServiceProvider;
use Arcanedev\Settings\SettingsServiceProvider;
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
        $this->app->register(SettingsServiceProvider::class);
        $this->app->register(HasherServiceProvider::class);
        $this->app->register(BreadcrumbsServiceProvider::class);
        $this->app->register(LogViewerServiceProvider::class);
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
}
