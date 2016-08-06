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

        $this->configSeoHelperPackage();
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
    /**
     * Register SEO Helper Package.
     */
    private function configSeoHelperPackage()
    {
        $config = $this->config();

        // Setting up the SEO Helper config.
        $config->set(
            'seo-helper.title.site-name',
            $config->get('arcanesoft.foundation.seo.site-name', 'ARCANESOFT')
        );
        $config->set(
            'seo-helper.misc.default.viewport',
            $config->get('arcanesoft.foundation.seo.viewport')
        );
    }

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
