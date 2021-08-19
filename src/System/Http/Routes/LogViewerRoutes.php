<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Routes;

use Arcanesoft\Foundation\System\Http\Controllers\LogViewerController;

/**
 * Class     LogViewerRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogViewerRoutes extends AbstractRouteRegistrar
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
        $this->prefix('log-viewer')->name('log-viewer.')->group(function (): void {
            // admin::system.log-viewer.index
            $this->get('/', [LogViewerController::class, 'index'])
                 ->name('index');

            $this->prefix('logs')->name('logs.')->group(function (): void {
                $this->prefix('{admin_log_file_date}')->group(function (): void {
                    // admin::system.log-viewer.logs.show
                    $this->get('/', [LogViewerController::class, 'showLog'])
                         ->name('show');

                    // admin::system.log-viewer.logs.download
                    $this->get('download', [LogViewerController::class, 'download'])
                         ->name('download');

                    // admin::system.log-viewer.logs.delete
                    $this->delete('delete', [LogViewerController::class, 'delete'])
                         ->middleware(['ajax'])
                         ->name('delete');

                    $this->prefix('{admin_log_level}')->group(function () {
                        // admin::system.log-viewer.logs.filter
                        $this->get('/', [LogViewerController::class, 'filter'])
                             ->name('filter');

                        // admin::system.log-viewer.logs.search
                        $this->get('search', [LogViewerController::class, 'search'])
                             ->name('search');
                    });
                });
            });
        });
    }
}
