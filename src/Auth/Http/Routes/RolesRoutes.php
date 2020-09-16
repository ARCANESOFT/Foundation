<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes;

use Arcanesoft\Foundation\Auth\Http\Controllers\RolesController;
use Arcanesoft\Foundation\Auth\Repositories\RolesRepository;

/**
 * Class     RolesRoutes
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesRoutes extends AbstractRouteRegistrar
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
        $this->adminGroup(function () {
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

                $this->prefix('{'.self::ROLE_WILDCARD.'}')->group(function () {
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
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $repo
     */
    public function bindings(RolesRepository $repo): void
    {
        $this->bind(self::ROLE_WILDCARD, function (string $uuid) use ($repo) {
            return $repo->firstWithUuidOrFail($uuid);
        });

        static::bindRouteClasses([
            Roles\PermissionsRoutes::class,
            Roles\AdministratorsRoutes::class,
        ]);
    }
}
