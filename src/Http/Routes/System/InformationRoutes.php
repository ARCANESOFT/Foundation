<?php namespace Arcanesoft\Foundation\Http\Routes\System;

use Arcanedev\Support\Bases\RouteRegister;
use Illuminate\Contracts\Routing\Registrar;

/**
 * Class     InformationRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class InformationRoutes extends RouteRegister
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Map routes.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     */
    public function map(Registrar $router)
    {
        $this->group(['prefix' => 'information', 'as' => 'information.'], function () {
            $this->get('/', [
                'as'   => 'index',
                'uses' => 'InformationController@index',
            ]);
        });
    }
}
