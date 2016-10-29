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
            System\LogViewerRoutes::register($this->router);
            System\RouteViewerRoutes::register($this->router);
        });
    }
}
