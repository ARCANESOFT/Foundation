<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Routes\Api;

use Arcanesoft\Foundation\Core\Http\Controllers\Api\EventsController;
use Arcanesoft\Foundation\Core\Http\Routes\AbstractRouteRegistrar;

/**
 * Class     EventsRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EventsRoutes extends AbstractRouteRegistrar
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
        $this->prefix('events')->name('events.')->group(function () {
            // admin::api.events.handle
            $this->post('/', [EventsController::class, 'handle'])
                 ->name('handle');
        });
    }
}
