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
            // admin::auth.roles.index
            $this->get('/', [RolesController::class, 'index'])
                 ->name('index');

            // admin::auth.roles.metrics
            $this->get('metrics', [RolesController::class, 'metrics'])
                 ->name('metrics');

            // admin::auth.roles.create
            $this->get('create', [RolesController::class, 'create'])
                 ->name('create');

            // admin::auth.roles.store
            $this->post('store', [RolesController::class, 'store'])
                 ->name('store');

            $this->prefix('{'.static::ROLE_WILDCARD.'}')->group(function () {
                // admin::auth.roles.show
                $this->get('/', [RolesController::class, 'show'])
                     ->name('show');

                // admin::auth.roles.edit
                $this->get('edit', [RolesController::class, 'edit'])
                     ->name('edit');

                // admin::auth.roles.update
                $this->put('update', [RolesController::class, 'update'])
                     ->name('update');

                // admin::auth.roles.activate
                $this->put('activate', [RolesController::class, 'activate'])
                     ->middleware(['ajax'])
                     ->name('activate');

                // admin::auth.roles.deactivate
                $this->put('deactivate', [RolesController::class, 'deactivate'])
                     ->middleware(['ajax'])
                     ->name('deactivate');

                // admin::auth.roles.delete
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
