<?php namespace Arcanesoft\Foundation\Http\Routes\System;

use Arcanedev\Support\Bases\RouteRegister;
use Illuminate\Contracts\Routing\Registrar;

/**
 * Class     LogViewerRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogViewerRoutes extends RouteRegister
{
    /**
     * Map routes.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     */
    public function map(Registrar $router)
    {
        $this->group([
            'prefix' => 'log-viewer',
            'as'     => 'log-viewer.',
        ], function () {
            $this->get('/', [
                'as'    => 'index', // foundation::system.log-viewer.index
                'uses'  => 'LogViewerController@index',
            ]);

            $this->group([
                'prefix' => 'logs',
                'as'     => 'logs.',
            ], function() {
                $this->get('/', [
                    'as'    => 'list', // foundation::system.log-viewer.logs.list
                    'uses'  => 'LogViewerController@listLogs',
                ]);

                $this->group([
                    'prefix'    => '{date}',
                ], function() {
                    $this->get('/', [
                        'as'    => 'show', // foundation::system.log-viewer.logs.show
                        'uses'  => 'LogViewerController@show',
                    ]);

                    $this->get('download', [
                        'as'    => 'download', // foundation::system.log-viewer.logs.download
                        'uses'  => 'LogViewerController@download',
                    ]);

                    $this->get('{level}', [
                        'as'    => 'filter', // foundation::system.log-viewer.logs.filter
                        'uses'  => 'LogViewerController@showByLevel',
                    ]);
                });

                $this->delete('delete', [
                    'as'    => 'delete', // foundation::system.log-viewer.logs.delete
                    'uses'  => 'LogViewerController@delete',
                ]);
            });
        });
    }
}