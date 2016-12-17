<?php namespace Arcanesoft\Foundation\Http\Routes\Admin;

use Arcanedev\Support\Bases\RouteRegister;
use Illuminate\Contracts\Routing\Registrar;

/**
 * Class     SystemRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SystemRoutes extends RouteRegister
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Map routes.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $this->group(['prefix' => 'system', 'as' => 'system.', 'namespace' => 'System'], function () {
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
        $this->group(['prefix' => 'information', 'as' => 'information.'], function () {
            $this->get('/',  'InformationController@index')
                ->name('index');
        });
    }

    /**
     * Register LogViewer routes.
     */
    private function registerLogViewerRoutes()
    {
        $this->group(['prefix' => 'log-viewer', 'as' => 'log-viewer.'], function () {
            $this->get('/', 'LogViewerController@index')
                 ->name('index'); // foundation::system.log-viewer.index

            $this->group(['prefix' => 'logs', 'as' => 'logs.'], function() {
                $this->get('/', 'LogViewerController@listLogs')
                     ->name('list'); // foundation::system.log-viewer.logs.list

                $this->group(['prefix' => '{date}'], function() {
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
        $this->group(['prefix' => 'routes', 'as' => 'routes.'], function () {
            $this->get('/', 'RoutesController@index')
                 ->name('index');
        });
    }
}
