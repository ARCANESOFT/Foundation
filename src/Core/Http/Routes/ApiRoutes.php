<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Routes;

use Arcanesoft\Foundation\Core\Http\Routes\Api\ComponentsRoutes;
use Arcanesoft\Foundation\Core\Http\Routes\Api\EventsRoutes;
use Arcanesoft\Foundation\Core\Http\Routes\Api\MetricsRoutes;
use Arcanesoft\Foundation\Core\Http\Controllers\Api\{ComponentsController, EventsController};

/**
 * Class     ApiRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ApiRoutes extends AbstractRouteRegistrar
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
        $this->adminApiGroup(function () {
            static::mapRouteClasses([
                EventsRoutes::class,
                ComponentsRoutes::class,
                MetricsRoutes::class,
            ]);
        });
    }
}
