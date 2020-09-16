<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Providers;

use Arcanedev\LaravelMetrics\Contracts\Manager;
use Illuminate\Support\ServiceProvider;

/**
 * Class     MetricServiceProvider
 *
 * @package  Arcanesoft\Foundation\Support\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class MetricServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The metrics.
     *
     * @var array
     */
    protected $metrics = [];

    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the metrics.
     *
     * @return iterable
     */
    public function metrics(): iterable
    {
        return $this->metrics;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register bindings in the container.
     */
    public function boot(): void
    {
        $this->registerMetrics();
    }

    /**
     * Register the metrics.
     */
    protected function registerMetrics(): void
    {
        $manager = $this->app->make(Manager::class);

        foreach ($this->metrics() as $metric) {
            $manager->register($metric);
        }
    }
}