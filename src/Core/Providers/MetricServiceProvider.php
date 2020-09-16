<?php

namespace Arcanesoft\Foundation\Core\Providers;

use Arcanesoft\Foundation\Support\Providers\MetricServiceProvider as ServiceProvider;

/**
 * Class     MetricServiceProvider
 *
 * @package  Arcanesoft\Foundation\Core\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetricServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the registered metrics.
     *
     * @return iterable
     */
    public function metrics(): iterable
    {
        return $this->app['config']->get('arcanesoft.foundation.metrics.registered', []);
    }
}