<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Routes\Web;

use Arcanesoft\Foundation\Authorization\Http\Controllers\UsersController;
use Arcanesoft\Foundation\Authorization\Repositories\UsersRepository;

/**
 * Class     UsersRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersRoutes extends RouteRegistrar
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
        $this->name('users.')->prefix('users')->group(function () {
            // admin::authorization.users.index
            $this->get('/', [UsersController::class, 'index'])
                 ->name('index');

            // admin::authorization.users.datatable
            $this->post('datatable', [UsersController::class, 'datatable'])
                 ->middleware(['ajax'])
                 ->name('datatable');

            // admin::authorization.users.metrics
            $this->get('metrics', [UsersController::class, 'metrics'])
                 ->name('metrics');

            // admin::authorization.users.create
            $this->get('create', [UsersController::class, 'create'])
                 ->name('create');

            // admin::authorization.users.post
            $this->post('store', [UsersController::class, 'store'])
                 ->name('store');

            $this->prefix('{'.static::USER_WILDCARD.'}')->group(function () {
                // admin::authorization.users.show
                $this->get('/', [UsersController::class, 'show'])
                     ->name('show');

                // admin::authorization.users.edit
                $this->get('edit', [UsersController::class, 'edit'])
                     ->name('edit');

                // admin::authorization.users.update
                $this->put('update', [UsersController::class, 'update'])
                     ->name('update');

                // admin::authorization.users.activate
                $this->put('activate', [UsersController::class, 'activate'])
                     ->middleware(['ajax'])
                     ->name('activate');

                // admin::authorization.users.deactivate
                $this->put('deactivate', [UsersController::class, 'deactivate'])
                     ->middleware(['ajax'])
                     ->name('deactivate');

                // admin::authorization.users.delete
                $this->delete('delete', [UsersController::class, 'delete'])
                     ->middleware(['ajax'])
                     ->name('delete');

                // admin::authorization.users.restore
                $this->put('restore', [UsersController::class, 'restore'])
                     ->middleware(['ajax'])
                     ->name('restore');

                if (impersonator()->isEnabled()) {
                    // admin::authorization.users.impersonate
                    $this->get('impersonate', [UsersController::class, 'impersonate'])
                         ->name('impersonate');
                }
            });
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\UsersRepository  $repo
     */
    public function bindings(UsersRepository $repo): void
    {
        $this->bind(static::USER_WILDCARD, function (string $uuid) use ($repo) {
            return $repo->firstWhereUuidOrFail($uuid);
        });
    }
}
