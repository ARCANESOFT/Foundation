<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Http\Routes\Web;

use Arcanesoft\Foundation\Cms\Http\Controllers\DashboardController;

/**
 * Class     DashboardRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardRoutes extends RouteRegistrar
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
        // admin::cms.index
        $this->get('/', [DashboardController::class, 'index'])
             ->name('index');
    }
}
