<?php namespace Arcanesoft\Foundation;

use Arcanesoft\Core\Bases\PackageServiceProvider;
use Arcanesoft\Core\CoreServiceProvider;

/**
 * Class     FoundationServiceProvider
 *
 * @package  Arcanesoft\Foundation
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FoundationServiceProvider extends PackageServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'foundation';

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the base path of the package.
     *
     * @return string
     */
    public function getBasePath()
    {
        return dirname(__DIR__);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerSidebarItems();
        $this->registerProviders([
            CoreServiceProvider::class,
            Providers\PackagesServiceProvider::class,
            Providers\AuthorizationServiceProvider::class,
        ]);
        $this->registerModuleProviders();
        $this->registerConsoleServiceProvider(Providers\CommandServiceProvider::class);
        $this->registerFoundationService();
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->registerProviders([
            Providers\RouteServiceProvider::class,
            Providers\ComposerServiceProvider::class,
        ]);

        // Publishes
        $this->publishConfig();
        $this->publishViews();
        $this->publishTranslations();
        $this->publishSidebarItems();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['arcanesoft.foundation'];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Services Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register Foundation service.
     */
    private function registerFoundationService()
    {
        $this->singleton('arcanesoft.foundation', Foundation::class);
    }

    /**
     * Register ARCANESOFT's modules (providers).
     */
    private function registerModuleProviders()
    {
        $this->registerProviders(
            $this->config()->get('arcanesoft.foundation.modules.providers', [])
        );
    }
}
