<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes;

use Arcanesoft\Foundation\Auth\Http\Controllers\PermissionsController;
use Arcanesoft\Foundation\Auth\Repositories\PermissionsRepository;

/**
 * Class     PermissionsRoutes
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsRoutes extends AbstractRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const PERMISSION_WILDCARD = 'admin_auth_permission';

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
            $this->prefix('permissions')->name('permissions.')->group(function () {
                // admin::auth.permissions.index
                $this->get('/', [PermissionsController::class, 'index'])
                     ->name('index');

                $this->prefix('{'.self::PERMISSION_WILDCARD.'}')->group(function () {
                    // admin::auth.permissions.show
                    $this->get('/', [PermissionsController::class, 'show'])
                         ->name('show');

                    $this->namespace('Permissions')->group(function () {
                        static::mapRouteClasses([
                            Permissions\RolesRoutes::class,
                        ]);
                    });
                });
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
        $this->bind(self::PERMISSION_WILDCARD, function (string $uuid) use ($repo) {
            return $repo->firstOrFailWhereUuid($uuid);
        });

        static::bindRouteClasses([
            Permissions\RolesRoutes::class,
        ]);
    }
}
