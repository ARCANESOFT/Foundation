<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Breadcrumbs\BreadcrumbsServiceProvider;
use Arcanedev\Hasher\HasherServiceProvider;
use Arcanedev\LogViewer\LogViewerServiceProvider;
use Arcanedev\Support\ServiceProvider;
use Arcanesoft\Auth\AuthServiceProvider;

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
        $this->app->register(HasherServiceProvider::class);
        $this->app->register(BreadcrumbsServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(LogViewerServiceProvider::class);
    }
}
