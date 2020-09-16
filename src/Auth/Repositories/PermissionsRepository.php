<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Repositories;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Events\Permissions\{Roles\DetachedRole, Roles\DetachingRole};
use Arcanesoft\Foundation\Auth\Models\{Administrator, Permission, Role};
use Illuminate\Support\Collection;

/**
 * Class     PermissionsRepository
 *
 * @package  Arcanesoft\Foundation\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @mixin  \Arcanesoft\Foundation\Auth\Models\Permission
 */
class PermissionsRepository extends AbstractRepository
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
     * @return \Arcanesoft\Foundation\Auth\Models\Permission|mixed
     */
    public function firstOrFailWhereUuid(string $uuid)
    {
        return $this->where('uuid', '=', $uuid)->firstOrFail();
    }

    /**
     * Get first role related to the permission by given uuid, or fail if not found.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission  $permission
     * @param  string                                         $uuid
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Role|mixed
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
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission  $permission
     * @param  \Arcanesoft\Foundation\Auth\Models\Role        $role
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
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission     $permission
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Role[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getFilteredRolesByAuthenticatedAdministrator(Permission $permission, Administrator $administrator)
    {
        return $permission
            ->roles()
            ->filterByAuthenticatedAdministrator($administrator)
            ->get();
    }
}
