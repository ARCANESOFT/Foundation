<?php namespace Arcanesoft\Foundation\Http\Routes;

use Arcanedev\Support\Bases\RouteRegister;
use Illuminate\Contracts\Routing\Registrar;

/**
 * Class     SystemRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SystemRoutes extends RouteRegister
{
    /**
     * Map routes.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $this->group(['prefix' => 'system', 'as' => 'system.', 'namespace' => 'System'], function () {
            $this->group(['prefix' => 'routes', 'as' => 'routes.'], function () {
                $this->get('/', [
                    'as'   => 'index',
                    'uses' => 'RoutesController@index',
                ]);
            });
        });
    }
}