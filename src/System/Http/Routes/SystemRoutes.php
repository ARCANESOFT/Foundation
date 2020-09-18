<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Routes;

use Arcanesoft\Foundation\System\Http\Controllers\SystemController;

/**
 * Class     SystemRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SystemRoutes extends AbstractRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->adminGroup(function () {
            // admin::system.index
            $this->get('/', [SystemController::class, 'index'])
                 ->name('index');

            static::mapRouteClasses([
                AbilitiesRoutes::class,
                DependenciesRoutes::class,
                LogViewerRoutes::class,
                MaintenanceRoutes::class,
                RoutesViewerRoutes::class,
            ]);
        });
    }
}
