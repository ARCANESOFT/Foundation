<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Controllers\Roles;

use Arcanesoft\Foundation\Authorization\Http\Controllers\Controller;
use Arcanesoft\Foundation\Authorization\Models\{Permission, Role};
use Arcanesoft\Foundation\Authorization\Policies\RolesPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\RolesRepository;
use Illuminate\Http\JsonResponse;

/**
 * Class     PermissionsController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role                   $role
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission             $permission
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\RolesRepository  $repo
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
