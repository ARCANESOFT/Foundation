<?php namespace Arcanesoft\Foundation\Http\Routes;

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
     * @param  Registrar  $router
     */
    public function map(Registrar $router)
    {
        parent::map($router);

        $this->group([
            'prefix' => 'log-viewer',
            'as'     => 'log-viewer.',
        ], function () {
            $this->get('/', [
                'as'    => 'index', // foundation::log-viewer.index
                'uses'  => 'LogViewerController@index',
            ]);
        });
    }
}
