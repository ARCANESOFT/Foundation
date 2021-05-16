<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Repositories;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Events\Permissions\{Roles\DetachedRole, Roles\DetachingRole};
use Arcanesoft\Foundation\Authorization\Models\{Administrator, Permission, Role};
use Illuminate\Support\Collection;

/**
 * Class     PermissionsRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @mixin  \Arcanesoft\Foundation\Authorization\Models\Permission
 */
class PermissionsRepository extends Repository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model FQN class.
     *
     * @return string
     */
    public static function modelClass(): string
    {
        return Auth::model('permission', Permission::class);
    }

    /* -----------------------------------------------------------------
     |  CRUD Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get all the permissions' ids.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllIds(): Collection
    {
        return $this->pluck('id');
    }

    /**
     * Get first permission with the given uuid, or fails.
     *
     * @param  string  $uuid
     *
     * @return \Arcanesoft\Foundation\Authorization\Models\Permission|mixed
     */
    public function firstOrFailWhereUuid(string $uuid)
    {
        return $this->where('uuid', '=', $uuid)->firstOrFail();
    }

    /**
     * Get first role related to the permission by given uuid, or fail if not found.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission  $permission
     * @param  string                                         $uuid
     *
     * @return \Arcanesoft\Foundation\Authorization\Models\Role|mixed
     */
    public function firstRoleWhereUuidOrFail(Permission $permission, string $uuid)
    {
        return $permission->roles()->where('uuid', $uuid)->firstOrFail();
    }

    /**
     * Get permissions' ids where in the given uuids.
     *
     * @param  array  $uuids
     *
     * @return \Illuminate\Support\Collection
     */
    public function getIdsWhereInUuid(array $uuids): Collection
    {
        return $this->whereIn('uuid', $uuids)->pluck('id');
    }

    /**
     * Detach role from permission.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission  $permission
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role        $role
     *
     * @return int
     */
    public function detachRole(Permission $permission, Role $role): int
    {
        event(new DetachingRole($permission, $role));
        $detached = $permission->roles()->detach($role);
        event(new DetachedRole($permission, $role, $detached));

        return $detached;
    }

    /**
     * Get the filtered roles by the given authenticated administrator.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission     $permission
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator  $administrator
     *
     * @return \Arcanesoft\Foundation\Authorization\Models\Role[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getFilteredRolesByAuthenticatedAdministrator(Permission $permission, Administrator $administrator)
    {
        return $permission
            ->roles()
            ->filterByAuthenticatedAdministrator($administrator)
            ->get();
    }
}
