<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Routes;

/**
 * Class     WebRoutes
 *
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
