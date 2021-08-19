<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Controllers\Permissions;

use Arcanesoft\Foundation\Authorization\Http\Controllers\Controller;
use Arcanesoft\Foundation\Authorization\Models\{Permission, Role};
use Arcanesoft\Foundation\Authorization\Policies\PermissionsPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\PermissionsRepository;

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
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission                   $permission
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role                         $role
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\PermissionsRepository  $repo
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
