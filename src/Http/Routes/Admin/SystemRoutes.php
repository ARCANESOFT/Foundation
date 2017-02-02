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
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Map routes.
     */
    public function map()
    {
        $this->prefix('system')->name('system.')->namespace('System')->group(function () {
            $this->registerSystemInformationRoutes();
            $this->registerLogViewerRoutes();
            $this->registerRouteViewerRoutes();
        });
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the system information routes.
     */
    private function registerSystemInformationRoutes()
    {
        $this->prefix('information')->name('information.')->group(function () {
            $this->get('/',  'InformationController@index')
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
                     ->name('list'); // foundation::system.log-viewer.logs.list

                $this->prefix('{date}')->group(function() {
                    $this->get('/', 'LogViewerController@show')
                         ->name('show'); // foundation::system.log-viewer.logs.show

                    $this->get('download', 'LogViewerController@download')
                         ->name('download'); // foundation::system.log-viewer.logs.download

                    $this->get('{level}', 'LogViewerController@showByLevel')
                         ->name('filter'); // foundation::system.log-viewer.logs.filter
                });

                $this->delete('delete', 'LogViewerController@delete')
                     ->name('delete'); // foundation::system.log-viewer.logs.delete
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
                 ->name('index'); // foundation::system.routes.index
        });
    }
}
