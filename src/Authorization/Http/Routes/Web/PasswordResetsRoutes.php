<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Routes\Web;

use Arcanesoft\Foundation\Authorization\Http\Controllers\PasswordResetsController;

/**
 * Class     PasswordResetsRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordResetsRoutes extends RouteRegistrar
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
        $this->name('password-resets.')->prefix('password-resets')->group(function () {
            // admin::authorization.password-resets.index
            $this->get('/', [PasswordResetsController::class, 'index'])
                 ->name('index');

            // admin::authorization.password-resets.metrics
            $this->get('metrics', [PasswordResetsController::class, 'metrics'])
                 ->name('metrics');
        });
    }
}
