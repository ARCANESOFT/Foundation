<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Routes;

use Arcanesoft\Foundation\System\Http\Controllers\AbilitiesController;

/**
 * Class     AbilitiesRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AbilitiesRoutes extends AbstractRouteRegistrar
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
        $this->prefix('abilities')->name('abilities.')->group(function (): void {
            // admin::system.abilities.index
            $this->get('/', [AbilitiesController::class, 'index'])
                 ->name('index');

            // admin::system.abilities.datatable
            $this->post('datatable', [AbilitiesController::class, 'datatable'])
                 ->name('datatable');

            // admin::system.abilities.show
            $this->get('{admin_ability_key}', [AbilitiesController::class, 'show'])
                 ->name('show');
        });
    }
}
