<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Repositories;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Models\PermissionsGroup;

/**
 * Class     PermissionsGroupsRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @mixin  \Arcanesoft\Foundation\Auth\Models\PermissionsGroup
 */
class PermissionsGroupsRepository extends AbstractRepository
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
        return Auth::model('permissions-group', PermissionsGroup::class);
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create a new permissions' group.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Auth\Models\PermissionsGroup|mixed
     */
    public function createOne(array $attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Create a new group with permissions.
     *
     * @param  array     $attributes
     * @param  iterable  $permissions
     *
     * @return \Arcanesoft\Foundation\Auth\Models\PermissionsGroup|mixed
     */
    public function createOneWithPermissions(array $attributes, iterable $permissions)
    {
        return tap($this->createOne($attributes), function (PermissionsGroup $group) use ($permissions) {
            $group->permissions()->saveMany($permissions);
        });
    }
}
