<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Routes\Web;

use Arcanesoft\Foundation\Authorization\Http\Controllers\DashboardController;

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
        // admin::authorization.index
        $this->get('/', [DashboardController::class, 'index'])
             ->name('index');
    }
}
