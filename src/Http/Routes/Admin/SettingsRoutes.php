<?php namespace Arcanesoft\Foundation\Http\Routes\Admin;

use Arcanedev\Support\Routing\RouteRegistrar;
use Illuminate\Contracts\Routing\Registrar;

/**
 * Class     SettingsRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SettingsRoutes extends RouteRegistrar
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
        $this->prefix('settings')->name('settings.')->group(function () {
            $this->get('/', 'SettingsController@index')
                 ->name('index'); // admin::foundation.settings.index
        });
    }
}
