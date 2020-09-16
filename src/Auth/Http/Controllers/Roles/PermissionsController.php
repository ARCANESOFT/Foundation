<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Roles;

use Arcanesoft\Foundation\Auth\Http\Controllers\Controller;
use Arcanesoft\Foundation\Auth\Models\{Permission, Role};
use Arcanesoft\Foundation\Auth\Policies\RolesPolicy;
use Arcanesoft\Foundation\Auth\Repositories\RolesRepository;
use Illuminate\Http\JsonResponse;

/**
 * Class     PermissionsController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  \Arcanesoft\Foundation\Auth\Models\Role                   $role
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission             $permission
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $repo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function detach(Role $role, Permission $permission, RolesRepository $repo): JsonResponse
    {
        $this->authorize(RolesPolicy::ability('permissions.detach'), [$role, $permission]);

        $repo->detachPermission($role, $permission);

        // TODO: Add notification

        return static::jsonResponseSuccess();
    }
}