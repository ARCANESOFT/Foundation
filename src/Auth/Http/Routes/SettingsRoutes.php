<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes;

use Arcanesoft\Foundation\Auth\Http\Controllers\SettingsController;

/**
 * Class     SettingsRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SettingsRoutes extends AbstractRouteRegistrar
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
        $this->adminGroup(function () {
            $this->name('settings.')->prefix('settings')->group(function () {
                // admin::auth.settings.index
                $this->get('/', [SettingsController::class, 'index'])
                    ->name('index');
            });
        });
    }
}
