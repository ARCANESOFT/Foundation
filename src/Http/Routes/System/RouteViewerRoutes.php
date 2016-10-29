<?php namespace Arcanesoft\Foundation\Http\Routes\System;

use Arcanedev\Support\Bases\RouteRegister;
use Illuminate\Contracts\Routing\Registrar;

/**
 * Class     RouteViewerRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteViewerRoutes extends RouteRegister
{
    /**
     * Map routes.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     */
    public function map(Registrar $router)
    {
        $this->group(['prefix' => 'routes', 'as' => 'routes.'], function () {
            $this->get('/', [
                'as'   => 'index',
                'uses' => 'RoutesController@index',
            ]);
        });
    }
}
