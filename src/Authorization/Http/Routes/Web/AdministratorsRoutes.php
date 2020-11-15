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
            // admin::authorization.administrators.index
            $this->get('/', [AdministratorsController::class, 'index'])
                 ->name('index');

            // admin::authorization.administrators.datatable
            $this->post('datatable', [AdministratorsController::class, 'datatable'])
                 ->middleware(['ajax'])
                 ->name('datatable');

            // admin::authorization.administrators.metrics
            $this->get('metrics', [AdministratorsController::class, 'metrics'])
                 ->name('metrics');

            // admin::authorization.administrators.create
            $this->get('create', [AdministratorsController::class, 'create'])
                 ->name('create');

            // admin::authorization.administrators.post
            $this->post('store', [AdministratorsController::class, 'store'])
                 ->name('store');

            $this->prefix('{'.static::WILDCARD_ADMIN.'}')->group(function () {
                // admin::authorization.administrators.show
                $this->get('/', [AdministratorsController::class, 'show'])
                     ->name('show');

                // admin::authorization.administrators.edit
                $this->get('edit', [AdministratorsController::class, 'edit'])
                     ->name('edit');

                // admin::authorization.administrators.update
                $this->put('update', [AdministratorsController::class, 'update'])
                     ->name('update');

                // admin::authorization.administrators.activate
                $this->put('activate', [AdministratorsController::class, 'activate'])
                     ->middleware(['ajax'])
                     ->name('activate');

                // admin::authorization.administrators.deactivate
                $this->put('deactivate', [AdministratorsController::class, 'deactivate'])
                     ->middleware(['ajax'])
                     ->name('deactivate');

                // admin::authorization.administrators.delete
                $this->delete('delete', [AdministratorsController::class, 'delete'])
                     ->middleware(['ajax'])
                     ->name('delete');

                // admin::authorization.administrators.restore
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
