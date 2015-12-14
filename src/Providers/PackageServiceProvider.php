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
        $this->registerSeoHelperPackage();
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
     * Register SEO Helper Package.
     */
    private function registerSeoHelperPackage()
    {
        $this->app->register(\Arcanedev\SeoHelper\SeoHelperServiceProvider::class);
        $this->alias('SeoHelper', \Arcanedev\SeoHelper\Facades\SeoHelper::class);

        // Setting up the SEO Helper config.
        $this->config()->set(
            'seo-helper.title.site-name',
            $this->config()->get('arcanesoft.foundation.seo.site-name', 'ARCANESOFT')
        );
        $this->config()->set(
            'seo-helper.misc.default.viewport',
            $this->config()->get('arcanesoft.foundation.seo.viewport')
        );
    }

    /**
     * Register the Hasher Package.
     */
    private function registerHasherPackage()
    {
        $this->app->register(\Arcanedev\Hasher\HasherServiceProvider::class);
        $this->alias('Hasher', \Arcanedev\Hasher\Facades\Hasher::class);
    }

    /**
     * Register the Breadcrumbs Package.
     */
    private function registerBreadcrumbsPackage()
    {
        $this->app->register(\Arcanedev\Breadcrumbs\BreadcrumbsServiceProvider::class);
        $this->alias('Breadcrumbs', \Arcanedev\Breadcrumbs\Facades\Breadcrumbs::class);
    }

    /**
     * Register the LogViewer Package.
     */
    private function registerLogViewerPackage()
    {
        $this->app->register(\Arcanedev\LogViewer\LogViewerServiceProvider::class);

        // Setting up the LogViewer config.
        $this->config()->set('log-viewer.route.enabled', false);
        $this->config()->set(
            'log-viewer.menu.filter-route',
            'foundation::log-viewer.logs.filter'
        );
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the config instance.
     *
     * @return \Illuminate\Contracts\Config\Repository
     */
    private function config()
    {
        return $this->app['config'];
    }
}
