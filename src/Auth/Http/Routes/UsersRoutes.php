<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes;

use Arcanesoft\Foundation\Auth\Http\Controllers\UsersController;
use Arcanesoft\Foundation\Auth\Repositories\UsersRepository;

/**
 * Class     UsersRoutes
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersRoutes extends AbstractRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const USER_WILDCARD = 'admin_auth_user';

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
            $this->name('users.')->prefix('users')->group(function () {
                // admin::auth.users.index
                $this->get('/', [UsersController::class, 'index'])
                     ->name('index');

                // admin::auth.users.trash
                $this->get('trash', [UsersController::class, 'trash'])
                     ->name('trash');

                // admin::auth.users.metrics
                $this->get('metrics', [UsersController::class, 'metrics'])
                     ->name('metrics');

                // admin::auth.users.create
                $this->get('create', [UsersController::class, 'create'])
                     ->name('create');

                // admin::auth.users.post
                $this->post('store', [UsersController::class, 'store'])
                     ->name('store');

                $this->prefix('{'.static::USER_WILDCARD.'}')->group(function () {
                    // admin::auth.users.show
                    $this->get('/', [UsersController::class, 'show'])
                         ->name('show');

                    // admin::auth.users.edit
                    $this->get('edit', [UsersController::class, 'edit'])
                         ->name('edit');

                    // admin::auth.users.update
                    $this->put('update', [UsersController::class, 'update'])
                         ->name('update');

                    // admin::auth.users.activate
                    $this->put('activate', [UsersController::class, 'activate'])
                         ->middleware(['ajax'])
                         ->name('activate');

                    // admin::auth.users.delete
                    $this->delete('delete', [UsersController::class, 'delete'])
                         ->middleware(['ajax'])
                         ->name('delete');

                    // admin::auth.users.restore
                    $this->put('restore', [UsersController::class, 'restore'])
                         ->middleware(['ajax'])
                         ->name('restore');

                    if (impersonator()->isEnabled()) {
                        // admin::auth.users.impersonate
                        $this->get('impersonate', [UsersController::class, 'impersonate'])
                             ->name('impersonate');
                    }
                });
            });
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\UsersRepository  $repo
     */
    public function bindings(UsersRepository $repo): void
    {
        $this->bind(static::USER_WILDCARD, function (string $uuid) use ($repo) {
            return $repo->firstWhereUuidOrFail($uuid);
        });
    }
}
