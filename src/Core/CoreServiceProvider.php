<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core;

use Arcanedev\LaravelMetrics\Metrics\Metric;
use Arcanesoft\Foundation\Support\Providers\ServiceProvider;
use Illuminate\Http\Request;

/**
 * Class     CoreServiceProvider
 *
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

        $this->extendMetricsAuthorization();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

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
