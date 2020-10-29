<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Routes\Web;

use Arcanesoft\Foundation\Authorization\Http\Controllers\SettingsController;

/**
 * Class     SettingsRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SettingsRoutes extends RouteRegistrar
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
        $this->name('settings.')->prefix('settings')->group(function () {
            // admin::auth.settings.index
            $this->get('/', [SettingsController::class, 'index'])
                ->name('index');
        });
    }
}
