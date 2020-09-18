<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes;

use Arcanesoft\Foundation\Auth\Http\Controllers\ProfileController;

/**
 * Class     ProfileRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ProfileRoutes extends AbstractRouteRegistrar
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
        });
    }
}
