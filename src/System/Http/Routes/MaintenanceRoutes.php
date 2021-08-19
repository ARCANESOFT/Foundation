<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Routes;

use Arcanesoft\Foundation\System\Http\Controllers\MaintenanceController;

/**
 * Class     MaintenanceRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MaintenanceRoutes extends AbstractRouteRegistrar
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
        $this->prefix('maintenance')->name('maintenance.')->group(function (): void {
            // admin::system.maintenance.index
            $this->get('/', [MaintenanceController::class, 'index'])
                 ->name('index');

            // admin::system.maintenance.start
            $this->post('start', [MaintenanceController::class, 'start'])
                 ->name('start');

            // admin::system.maintenance.stop
            $this->post('stop', [MaintenanceController::class, 'stop'])
                 ->name('stop');
        });
    }
}
