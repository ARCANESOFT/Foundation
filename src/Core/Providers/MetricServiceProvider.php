<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Providers;

use Arcanesoft\Foundation\Support\Providers\MetricServiceProvider as ServiceProvider;

/**
 * Class     MetricServiceProvider
 *
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
