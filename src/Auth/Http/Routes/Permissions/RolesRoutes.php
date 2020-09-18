<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes\Permissions;

use Arcanesoft\Foundation\Auth\Http\Controllers\Permissions\RolesController;
use Arcanesoft\Foundation\Auth\Http\Routes\PermissionsRoutes;
use Arcanesoft\Foundation\Auth\Http\Routes\AbstractRouteRegistrar;
use Arcanesoft\Foundation\Auth\Repositories\PermissionsRepository;
use Illuminate\Routing\Route;

/**
 * Class     RolesRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesRoutes extends AbstractRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const ROLE_WILDCARD = 'admin_auth_permission_role';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->prefix('roles')->name('roles.')->group(function () {
            $this->prefix('{'.self::ROLE_WILDCARD.'}')->group(function () {
                // admin::auth.permissions.roles.detach
                $this->delete('detach', [RolesController::class, 'detach'])
                     ->name('detach');
            });
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\PermissionsRepository  $repo
     */
    public function bindings(PermissionsRepository $repo): void
    {
        $this->bind(self::ROLE_WILDCARD, function (string $uuid, Route $route) use ($repo) {
            /** @var  \Arcanesoft\Foundation\Auth\Models\Permission  $permission */
            $permission = $route->parameter(PermissionsRoutes::PERMISSION_WILDCARD);

            return $repo->firstRoleWhereUuidOrFail($permission, $uuid);
        });
    }
}
