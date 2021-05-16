<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Http\Routes;

use Arcanedev\Support\Routing\RouteRegistrar;
use Arcanesoft\Foundation\Authentication\Http\Controllers\PasswordResetLinkController;
use Arcanesoft\Foundation\Authentication\Http\Controllers\ResetPasswordController;

/**
 * Class     PasswordResetRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordResetRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    public const REQUEST = 'admin::auth.password.request';
    public const EMAIL   = 'admin::auth.password.email';
    public const RESET   = 'admin::auth.password.reset';
    public const UPDATE  = 'admin::auth.password.update';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        // TODO: Change the `guest` middleware?
        $this->prefix('password')->name('password.')->middleware(['guest'])->group(function (): void {
                 // admin::auth.password.request
                 $this->get('forgotten', [PasswordResetLinkController::class, 'create'])
                      ->name('request');

                 // admin::auth.password.email
                 $this->post('forgotten', [PasswordResetLinkController::class, 'store'])
                      ->name('email');

                 // admin::auth.password.reset
                 $this->get('reset/{token}', [ResetPasswordController::class, 'edit'])
                      ->name('reset');

                 // admin::auth.password.update
                 $this->post('reset', [ResetPasswordController::class, 'update'])
                      ->name('update');
             });
    }
}
