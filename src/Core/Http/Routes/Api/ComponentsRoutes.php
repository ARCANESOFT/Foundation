<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Routes\Api;

use Arcanesoft\Foundation\Core\Http\Controllers\Api\ComponentsController;
use Arcanesoft\Foundation\Core\Http\Routes\AbstractRouteRegistrar;

/**
 * Class     ComponentsRoutes
 *
 * @package  Arcanesoft\Foundation\Core\Http\Routes\Api
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ComponentsRoutes extends AbstractRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->prefix('components')->name('components.')->group(function () {
            // admin::api.components.handle
            $this->post('/', [ComponentsController::class, 'handle'])
                 ->name('handle');
        });
    }
}
