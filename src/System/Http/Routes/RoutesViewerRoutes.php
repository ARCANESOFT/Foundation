<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Routes;

use Arcanesoft\Foundation\System\Http\Controllers\RoutesViewerController;

/**
 * Class     RoutesViewerRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoutesViewerRoutes extends AbstractRouteRegistrar
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
        $this->prefix('routes-viewer')->name('routes-viewer.')->group(function (): void {
            // admin::system.routes-viewer.index
            $this->get('/', [RoutesViewerController::class, 'index'])
                 ->name('index');

            // admin::system.routes-viewer.index
            $this->post('datatable', [RoutesViewerController::class, 'datatable'])
                 ->middleware(['ajax'])
                 ->name('datatable');
        });
    }
}
