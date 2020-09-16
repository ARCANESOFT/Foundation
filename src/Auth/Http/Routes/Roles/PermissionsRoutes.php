<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes\Roles;

use Arcanesoft\Foundation\Auth\Http\Controllers\Roles\PermissionsController;
use Arcanesoft\Foundation\Auth\Http\Routes\{RolesRoutes, AbstractRouteRegistrar};
use Arcanesoft\Foundation\Auth\Repositories\RolesRepository;
use Illuminate\Routing\Route;

/**
 * Class     PermissionsRoutes
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Routes\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsRoutes extends AbstractRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const PERMISSION_WILDCARD = 'admin_auth_role_permission';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->prefix('permissions')->name('permissions.')->group(function () {
            $this->prefix('{'.self::PERMISSION_WILDCARD.'}')->group(function () {
                // admin::auth.roles.permissions.detach
                $this->delete('detach', [PermissionsController::class, 'detach'])
                    ->name('detach');
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
        $this->bind(self::PERMISSION_WILDCARD, function (string $uuid, Route $route) use ($repo) {
            /** @var  \Arcanesoft\Foundation\Auth\Models\Role  $role */
            $role = $route->parameter(RolesRoutes::ROLE_WILDCARD);

            return $repo->firstPermissionWithUuidOrFail($role, $uuid);
        });
    }
}