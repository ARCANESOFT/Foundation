<?php declare(strict_types=1);

namespace Arcanesoft\Foundation;

use Arcanesoft\Foundation\Authorization\AuthServiceProvider;
use Arcanesoft\Foundation\Authentication\AuthenticationServiceProvider;
use Arcanesoft\Foundation\Cms\CmsServiceProvider;
use Arcanesoft\Foundation\Core\CoreServiceProvider;
use Arcanesoft\Foundation\Fortify\FortifyServiceProvider;
use Arcanesoft\Foundation\Support\Providers\PackageServiceProvider;
use Arcanesoft\Foundation\System\SystemServiceProvider;
use Arcanesoft\Foundation\Views\ViewsServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;

/**
 * Class     FoundationServiceProvider
 *
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

    /**
     * Merge multiple config files into one instance (package name as root key).
     *
     * @var bool
     */
    protected $multiConfigs = true;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerConfig();

        $this->registerProviders([
            CoreServiceProvider::class,
            FortifyServiceProvider::class,
            AuthenticationServiceProvider::class,
            AuthServiceProvider::class,
            CmsServiceProvider::class,
            SystemServiceProvider::class,
            ViewsServiceProvider::class,
        ]);

        $this->commands([
            Console\DiscoverCommand::class,
            Console\InstallCommand::class,
            Console\PublishCommand::class,
        ]);

        $this->registerModuleManifest();
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->loadTranslations();
        $this->loadViews();

        if ($this->app->runningInConsole()) {
            $this->publishAssets();
            $this->publishConfig();
            $this->publishTranslations();
            $this->publishViews();

            Arcanesoft::$runsMigrations
                ? $this->loadMigrations()
                : $this->publishMigrations();
        }
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the module manifest.
     */
    protected function registerModuleManifest(): void
    {
        $this->singleton(PackageManifest::class, function (Application $app) {
            return new PackageManifest(new Filesystem, $app->basePath());
        });

        $this->singleton(ModuleManifest::class, function (Application $app) {
            return new ModuleManifest(
                new Filesystem, $app->basePath(), $app->bootstrapPath(Arcanesoft::ARCANESOFT_MODULES_CACHE)
            );
        });
    }
}
