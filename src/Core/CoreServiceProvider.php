<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core;

use Arcanedev\LaravelMetrics\Metrics\Metric;
use Arcanesoft\Foundation\Support\Providers\ServiceProvider;
use Illuminate\Http\Request;

/**
 * Class     CoreServiceProvider
 *
 * @package  Arcanesoft\Foundation\Core
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CoreServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
    |  Main Methods
    | -----------------------------------------------------------------
    */

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->registerProviders([
            Providers\AuthServiceProvider::class,
            Providers\EventServiceProvider::class,
            Providers\MetricServiceProvider::class,
            Providers\RouteServiceProvider::class,
            Providers\ViewServiceProvider::class,
        ]);

        $this->registerModulesServiceProviders();

        $this->extendMetricsAuthorization();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the ARCANESOFT's modules.
     */
    private function registerModulesServiceProviders(): void
    {
        $this->registerProviders(
            $this->app['config']->get('arcanesoft.foundation.modules.providers', [])
        );
    }

    /**
     * Extend metrics authorization.
     */
    private function extendMetricsAuthorization(): void
    {
        Metric::macro('authorizedToSee', function (Request $request): bool {
            return method_exists($this, 'authorize')
                ? $this->authorize($request) === true
                : true;
        });
    }
}
