<?php namespace Arcanesoft\Foundation\Http\Routes;

use Arcanedev\Support\Bases\RouteRegister;
use Illuminate\Contracts\Routing\Registrar;

/**
 * Class     SettingsRoute
 *
 * @package  Arcanesoft\Foundation\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SettingsRoutes extends RouteRegister
{
    /**
     * Map routes.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     */
    public function map(Registrar $router)
    {
        $this->group([
            'prefix' => 'settings',
            'as'     => 'settings.',
        ], function () {
            $this->get('/', [
                'as'    => 'index', // foundation::settings.index
                'uses'  => 'SettingsController@index',
            ]);
        });
    }
}
