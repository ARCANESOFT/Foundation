<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Routes\Api;

use Arcanesoft\Foundation\Core\Http\Controllers\Api\MetricsController;
use Arcanesoft\Foundation\Core\Http\Routes\AbstractRouteRegistrar;

/**
 * Class     MetricsRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetricsRoutes extends AbstractRouteRegistrar
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
        $this->prefix('metrics')->name('metrics.')->group(function () {
            // admin::api.metrics.handle
            $this->post('/', [MetricsController::class, 'handle'])
                 ->name('handle');
        });
    }
}
