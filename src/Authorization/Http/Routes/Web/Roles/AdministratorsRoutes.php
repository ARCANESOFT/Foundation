<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Routes\Web\Roles;

use Arcanesoft\Foundation\Authorization\Http\Controllers\Roles\AdministratorsController;
use Arcanesoft\Foundation\Authorization\Http\Routes\Web\{RolesRoutes, RouteRegistrar};
use Arcanesoft\Foundation\Authorization\Repositories\RolesRepository;
use Illuminate\Routing\Route;

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

    const USER_WILDCARD = 'admin_auth_role_administrator';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->prefix('administrators')->name('administrators.')->group(function () {
            $this->prefix('{'.static::USER_WILDCARD.'}')->group(function () {
                // admin::auth.roles.administrators.detach
                $this->delete('detach', [AdministratorsController::class, 'detach'])
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
        $this->bind(static::USER_WILDCARD, function (string $uuid, Route $route) use ($repo) {
            /** @var  \Arcanesoft\Foundation\Authorization\Models\Role  $role */
            $role = $route->parameter(RolesRoutes::ROLE_WILDCARD);

            return $repo->firstAdministratorWithUuidOrFail($role, $uuid);
        });
    }
}
