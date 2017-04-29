<?php namespace Arcanesoft\Foundation\Http\Routes\Admin;

use Arcanedev\Support\Routing\RouteRegistrar;

/**
 * Class     SystemRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SystemRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map routes.
     */
    public function map()
    {
        $this->namespace('System')->prefix('system')->name('system.')->group(function () {
            $this->registerSystemInformationRoutes();
            $this->registerLogViewerRoutes();
            $this->registerRouteViewerRoutes();
            $this->registerBackupsRoutes();
        });
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the system information routes.
     */
    private function registerSystemInformationRoutes()
    {
        $this->prefix('information')->name('information.')->group(function () {
            $this->get('/', 'InformationController@index')
                 ->name('index');  // admin::foundation.system.information.index
        });
    }

    /**
     * Register LogViewer routes.
     */
    private function registerLogViewerRoutes()
    {
        $this->prefix('log-viewer')->name('log-viewer.')->group(function () {
            $this->get('/', 'LogViewerController@index')
                 ->name('index'); // admin::foundation.system.log-viewer.index

            $this->prefix('logs')->name('logs.')->group(function() {
                $this->get('/', 'LogViewerController@listLogs')
                     ->name('list'); // admin::foundation.system.log-viewer.logs.list

                $this->prefix('{log_date}')->group(function () {
                    $this->get('/', 'LogViewerController@show')
                         ->name('show'); // admin::foundation.system.log-viewer.logs.show

                    $this->get('download', 'LogViewerController@download')
                         ->name('download'); // admin::foundation.system.log-viewer.logs.download

                    $this->get('{level}', 'LogViewerController@showByLevel')
                         ->name('filter'); // admin::foundation.system.log-viewer.logs.filter

                    $this->delete('delete', 'LogViewerController@delete')
                         ->middleware('ajax')
                         ->name('delete'); // admin::foundation.system.log-viewer.logs.delete
                });
            });
        });
    }

    /**
     * Register the route viewer routes.
     */
    private function registerRouteViewerRoutes()
    {
        $this->prefix('routes')->name('routes.')->group(function () {
            $this->get('/', 'RoutesController@index')
                 ->name('index'); // admin::foundation.system.routes.index
        });
    }

    /**
     * Register the backups routes.
     */
    private function registerBackupsRoutes()
    {
        $this->prefix('backups')->name('backups.')->group(function () {
            $this->get('/', 'BackupsController@index')
                 ->name('index');   // admin::foundation.system.backups.index

            $this->post('backup', 'BackupsController@backup')
                 ->middleware('ajax')
                 ->name('backup'); // admin::foundation.system.backups.backup

            $this->post('clear', 'BackupsController@clear')
                 ->middleware('ajax')
                 ->name('clear');  // admin::foundation.system.backups.clear

            $this->get('{index}', 'BackupsController@show')
                 ->name('show');    // admin::foundation.system.backups.show
        });
    }
}
