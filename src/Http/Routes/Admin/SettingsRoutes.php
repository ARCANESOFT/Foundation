<?php namespace Arcanesoft\Foundation\Http\Routes\Admin;

use Arcanedev\Support\Bases\RouteRegister;
use Illuminate\Contracts\Routing\Registrar;

/**
 * Class     SettingsRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SettingsRoutes extends RouteRegister
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
        $this->group(['prefix' => 'settings', 'as' => 'settings.'], function () {
            $this->get('/', 'SettingsController@index')
                 ->name('index'); // admin::foundation.settings.index
        });
    }
}
