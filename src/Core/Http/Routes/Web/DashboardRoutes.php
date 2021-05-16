<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Routes\Web;

use Arcanesoft\Foundation\Core\Http\Controllers\DashboardController;
use Arcanesoft\Foundation\Core\Http\Routes\AbstractRouteRegistrar;

/**
 * Class     DashboardRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardRoutes extends AbstractRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    public const INDEX = 'admin::index';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the routes.
     */
    public function map(): void
    {
        // admin::index
        $this->get('/', [DashboardController::class, 'index'])
             ->name('index');
    }
}
