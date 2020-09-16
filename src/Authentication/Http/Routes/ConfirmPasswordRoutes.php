<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Http\Routes;

use Arcanedev\Support\Routing\RouteRegistrar;
use Arcanesoft\Foundation\Authentication\Http\Controllers\ConfirmPasswordController;

/**
 * Class     ConfirmPasswordRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ConfirmPasswordRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    public const CREATE = 'admin::auth.password.confirm.create';
    public const STORE  = 'admin::auth.password.confirm.store';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->prefix('password/confirm')
             ->name('password.confirm.')
             ->middleware(['arcanesoft'])
             ->group(function () {
                 // admin::auth.password.confirm.create
                 $this->get('/', [ConfirmPasswordController::class, 'create'])
                      ->name('create');

                 // admin::auth.password.confirm.store
                 $this->post('/', [ConfirmPasswordController::class, 'store'])
                      ->name('store');
             });
    }

}
