<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Routes\Web;

use Arcanesoft\Foundation\Authorization\Http\Controllers\ProfileController;

/**
 * Class     ProfileRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ProfileRoutes extends RouteRegistrar
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
        $this->prefix('profile')->name('profile.')->middleware(['administrator.password.confirm'])->group(function () {
            // admin::auth.profile.index
            $this->get('/', [ProfileController::class, 'index'])
                 ->name('index');

            // Account
            $this->prefix('account')->name('account.')->group(function () {
                // admin::auth.profile.account.update
                $this->put('update', [ProfileController::class, 'updateAccount'])
                     ->name('update');
            });

            // Password
            $this->prefix('password')->name('password.')->group(function () {
                // admin::auth.profile.password.update
                $this->put('update', [ProfileController::class, 'updatePassword'])
                     ->name('update');
            });
        });
    }
}
