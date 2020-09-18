<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Permissions;

use Arcanesoft\Foundation\Auth\Http\Controllers\Controller;
use Arcanesoft\Foundation\Auth\Models\{Permission, Role};
use Arcanesoft\Foundation\Auth\Policies\PermissionsPolicy;
use Arcanesoft\Foundation\Auth\Repositories\PermissionsRepository;

/**
 * Class     RolesController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Detach the given role from the permission.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission                   $permission
     * @param  \Arcanesoft\Foundation\Auth\Models\Role                         $role
     * @param  \Arcanesoft\Foundation\Auth\Repositories\PermissionsRepository  $repo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function detach(Permission $permission, Role $role, PermissionsRepository $repo)
    {
        $this->authorize(PermissionsPolicy::ability('roles.detach'), [$permission, $role]);

        $repo->detachRole($permission, $role);

        // TODO: Add notification

        return static::jsonResponseSuccess();
    }
}
