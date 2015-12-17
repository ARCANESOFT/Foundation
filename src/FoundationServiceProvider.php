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
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Package name.
     *
     * @var string
     */
    protected $package      = 'foundation';

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

        $this->app->register(\Arcanesoft\Core\CoreServiceProvider::class);
        $this->app->register(Providers\PackagesServiceProvider::class);
        $this->app->register(Providers\ModuleServiceProvider::class);
        $this->app->register(Providers\AuthorizationServiceProvider::class);
        $this->registerFoundationService();

        if ($this->app->runningInConsole()) {
            $this->app->register(Providers\CommandServiceProvider::class);
        }
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->registerPublishes();

        $this->app->register(Providers\RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'arcanesoft.foundation',
        ];
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

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    private function registerPublishes()
    {
        $basePath = $this->getBasePath();

        // Config
        $this->publishes([
            $this->getConfigFile() => config_path($this->vendor . DS . "{$this->package}.php")
        ]);

        // Views
        $viewsPath = "$basePath/resources/views";
        $this->loadViewsFrom($viewsPath, 'foundation');
        $this->publishes([
            $viewsPath => base_path('resources/views/vendor/foundation'),
        ], 'views');

        // Translations
        $translationsPath = "$basePath/resources/lang";
        $this->loadTranslationsFrom($translationsPath, 'foundation');
        $this->publishes([
            $translationsPath => base_path('resources/lang/vendor/foundation'),
        ], 'lang');

        // Assets
        $this->publishes([
            "$basePath/resources/assets/dist" => public_path('vendor/foundation'),
        ], 'assets');
    }
}
