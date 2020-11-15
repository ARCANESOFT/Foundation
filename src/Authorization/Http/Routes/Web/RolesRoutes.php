<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Routes\Web;

use Arcanesoft\Foundation\Authorization\Http\Controllers\RolesController;
use Arcanesoft\Foundation\Authorization\Repositories\RolesRepository;

/**
 * Class     RolesRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const ROLE_WILDCARD = 'admin_auth_role';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->name('roles.')->prefix('roles')->group(function () {
            // admin::authorization.roles.index
            $this->get('/', [RolesController::class, 'index'])
                 ->name('index');

            // admin::authorization.roles.datatable
            $this->post('datatable', [RolesController::class, 'datatable'])
                 ->middleware(['ajax'])
                 ->name('datatable');

            // admin::authorization.roles.metrics
            $this->get('metrics', [RolesController::class, 'metrics'])
                 ->name('metrics');

            // admin::authorization.roles.create
            $this->get('create', [RolesController::class, 'create'])
                 ->name('create');

            // admin::authorization.roles.store
            $this->post('store', [RolesController::class, 'store'])
                 ->name('store');

            $this->prefix('{'.static::ROLE_WILDCARD.'}')->group(function () {
                // admin::authorization.roles.show
                $this->get('/', [RolesController::class, 'show'])
                     ->name('show');

                // admin::authorization.roles.edit
                $this->get('edit', [RolesController::class, 'edit'])
                     ->name('edit');

                // admin::authorization.roles.update
                $this->put('update', [RolesController::class, 'update'])
                     ->name('update');

                // admin::authorization.roles.activate
                $this->put('activate', [RolesController::class, 'activate'])
                     ->middleware(['ajax'])
                     ->name('activate');

                // admin::authorization.roles.deactivate
                $this->put('deactivate', [RolesController::class, 'deactivate'])
                     ->middleware(['ajax'])
                     ->name('deactivate');

                // admin::authorization.roles.delete
                $this->delete('delete', [RolesController::class, 'delete'])
                     ->middleware(['ajax'])
                     ->name('delete');

                $this->namespace('Roles')->group(function () {
                    static::mapRouteClasses([
                        Roles\AdministratorsRoutes::class,
                        Roles\PermissionsRoutes::class,
                    ]);
                });
            });
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\RolesRepository  $repo
     */
    public function bindings(RolesRepository $repo): void
    {
        $this->bind(static::ROLE_WILDCARD, function (string $uuid) use ($repo) {
            return $repo->firstWithUuidOrFail($uuid);
        });

        static::bindRouteClasses([
            Roles\PermissionsRoutes::class,
            Roles\AdministratorsRoutes::class,
        ]);
    }
}
