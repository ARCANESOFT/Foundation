<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System;

use Arcanesoft\Foundation\Support\Providers\ServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class     SystemServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SystemServiceProvider extends ServiceProvider
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
            Providers\RouteServiceProvider::class,
            Providers\ViewServiceProvider::class,
        ]);

        $this->app->booting(function (Application $app) {
            /** @var  \Illuminate\Contracts\Config\Repository  $config */
            $config = $app['config'];

            $this->updateLogViewerConfig($config);
            $this->updateRouteViewerConfig($config);
        });
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Edit the LogViewer's config file.
     *
     * @param  \Illuminate\Contracts\Config\Repository  $config
     */
    private function updateLogViewerConfig(Repository $config): void
    {
        $config->set('log-viewer.route.enabled', false);
        $config->set('log-viewer.menu.filter-route', 'admin::system.log-viewer.logs.filter');
    }

    /**
     * Edit the LogViewer's config file.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    private function updateRouteViewerConfig(Repository $config): void
    {
        $config->set('route-viewer.route.enabled', false);
    }
}
