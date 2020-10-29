<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Routes\Web;

use Arcanesoft\Foundation\Authorization\Http\Controllers\AdministratorsController;
use Arcanesoft\Foundation\Authorization\Repositories\AdministratorsRepository;

/**
 * Class     AdministratorsRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdministratorsRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const WILDCARD_ADMIN = 'admin_auth_administrator';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->name('administrators.')->prefix('administrators')->group(function () {
            // admin::auth.administrators.index
            $this->get('/', [AdministratorsController::class, 'index'])
                 ->name('index');

            // admin::auth.administrators.trash
            $this->get('trash', [AdministratorsController::class, 'trash'])
                 ->name('trash');

            // admin::auth.administrators.metrics
            $this->get('metrics', [AdministratorsController::class, 'metrics'])
                 ->name('metrics');

            // admin::auth.administrators.create
            $this->get('create', [AdministratorsController::class, 'create'])
                 ->name('create');

            // admin::auth.administrators.post
            $this->post('store', [AdministratorsController::class, 'store'])
                 ->name('store');

            $this->prefix('{'.static::WILDCARD_ADMIN.'}')->group(function () {
                // admin::auth.administrators.show
                $this->get('/', [AdministratorsController::class, 'show'])
                     ->name('show');

                // admin::auth.administrators.edit
                $this->get('edit', [AdministratorsController::class, 'edit'])
                     ->name('edit');

                // admin::auth.administrators.update
                $this->put('update', [AdministratorsController::class, 'update'])
                     ->name('update');

                // admin::auth.administrators.activate
                $this->put('activate', [AdministratorsController::class, 'activate'])
                     ->middleware(['ajax'])
                     ->name('activate');

                // admin::auth.administrators.deactivate
                $this->put('deactivate', [AdministratorsController::class, 'deactivate'])
                     ->middleware(['ajax'])
                     ->name('deactivate');

                // admin::auth.administrators.delete
                $this->delete('delete', [AdministratorsController::class, 'delete'])
                     ->middleware(['ajax'])
                     ->name('delete');

                // admin::auth.administrators.restore
                $this->put('restore', [AdministratorsController::class, 'restore'])
                     ->middleware(['ajax'])
                     ->name('restore');

                static::mapRouteClasses([
                    Administrators\SessionsRoutes::class
                ]);
            });
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\AdministratorsRepository  $repo
     */
    public function bindings(AdministratorsRepository $repo): void
    {
        $this->bind(static::WILDCARD_ADMIN, function (string $uuid) use ($repo) {
            return $repo->firstWhereUuidOrFail($uuid);
        });

        static::bindRouteClasses([
            Administrators\SessionsRoutes::class
        ]);
    }
}
