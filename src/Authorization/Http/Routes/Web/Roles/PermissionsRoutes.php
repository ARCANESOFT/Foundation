<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Routes\Web\Roles;

use Arcanesoft\Foundation\Authorization\Http\Controllers\Roles\PermissionsController;
use Arcanesoft\Foundation\Authorization\Http\Routes\Web\{RolesRoutes, RouteRegistrar};
use Arcanesoft\Foundation\Authorization\Repositories\RolesRepository;
use Illuminate\Routing\Route;

/**
 * Class     PermissionsRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsRoutes extends RouteRegistrar
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
            $this->prefix('{'.static::PERMISSION_WILDCARD.'}')->group(function () {
                // admin::auth.roles.permissions.detach
                $this->delete('detach', [PermissionsController::class, 'detach'])
                     ->name('detach');
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
        $this->bind(static::PERMISSION_WILDCARD, function (string $uuid, Route $route) use ($repo) {
            /** @var  \Arcanesoft\Foundation\Authorization\Models\Role  $role */
            $role = $route->parameter(RolesRoutes::ROLE_WILDCARD);

            return $repo->firstPermissionWithUuidOrFail($role, $uuid);
        });
    }
}
