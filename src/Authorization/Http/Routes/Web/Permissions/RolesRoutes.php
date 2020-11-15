<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Routes\Web\Permissions;

use Arcanesoft\Foundation\Authorization\Http\Controllers\Permissions\RolesController;
use Arcanesoft\Foundation\Authorization\Http\Routes\Web\{PermissionsRoutes, RouteRegistrar};
use Arcanesoft\Foundation\Authorization\Repositories\PermissionsRepository;
use Illuminate\Routing\Route;

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
            $this->prefix('{'.static::ROLE_WILDCARD.'}')->group(function () {
                // admin::authorization.permissions.roles.detach
                $this->delete('detach', [RolesController::class, 'detach'])
                     ->name('detach');
            });
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\PermissionsRepository  $repo
     */
    public function bindings(PermissionsRepository $repo): void
    {
        $this->bind(static::ROLE_WILDCARD, function (string $uuid, Route $route) use ($repo) {
            /** @var  \Arcanesoft\Foundation\Authorization\Models\Permission  $permission */
            $permission = $route->parameter(PermissionsRoutes::PERMISSION_WILDCARD);

            return $repo->firstRoleWhereUuidOrFail($permission, $uuid);
        });
    }
}
