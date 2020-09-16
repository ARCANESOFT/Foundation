<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Routes;

/**
 * Class     WebRoutes
 *
 * @package  Arcanesoft\Foundation\Core\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class WebRoutes extends AbstractRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the routes.
     */
    public function map(): void
    {
        $this->adminGroup(function () {
            static::mapRouteClasses([
                Web\DashboardRoutes::class,
            ]);
        });
    }
}
