<?php namespace Arcanesoft\Foundation;

use Arcanesoft\Core\Bases\PackageServiceProvider;

/**
 * Class     FoundationServiceProvider
 *
 * @package  Arcanesoft\Foundation
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FoundationServiceProvider extends PackageServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'foundation';

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

        $this->registerConfig();
        $this->registerSidebarItems();

        $this->registerProviders([
            Providers\PackagesServiceProvider::class,
            Providers\AuthorizationServiceProvider::class,
            Providers\RouteServiceProvider::class,
            Providers\ViewComposerServiceProvider::class,
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
        parent::boot();

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
        return [
            Contracts\Foundation::class,
        ];
    }

    /* -----------------------------------------------------------------
     |  Services Functions
     | -----------------------------------------------------------------
     */

    /**
     * Register Foundation service.
     */
    private function registerFoundationService()
    {
        $this->singleton(Contracts\Foundation::class, Foundation::class);
    }

    /**
     * Register ARCANESOFT's modules (providers).
     */
    private function registerModuleProviders()
    {
        $providers = $this->config()->get('arcanesoft.foundation.modules.providers', []);

        if (count($providers) > 0)
            $this->registerProviders($providers);
    }
}
