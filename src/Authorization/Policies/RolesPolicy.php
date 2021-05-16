<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Policies;

use Arcanesoft\Foundation\Authorization\Models\{Administrator, Permission, Role};

/**
 * Class     RolesPolicy
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesPolicy extends AbstractPolicy
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the ability's prefix.
     *
     * @return string
     */
    protected static function prefix(): string
    {
        return 'admin::authorization.roles.';
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's abilities.
     *
     * @return \Arcanedev\LaravelPolicies\Ability[]|iterable
     */
    public function abilities(): iterable
    {
        $this->setMetas([
            'category' => 'Roles',
        ]);

        return [

            // admin::authorization.roles.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the roles',
                'description' => 'Ability to list all the roles',
            ]),

            // admin::authorization.roles.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show a role',
                'description' => "Ability to show the role's details",
            ]),

            // admin::authorization.roles.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new role',
                'description' => 'Ability to create a new role',
            ]),

            // admin::authorization.roles.update
            $this->makeAbility('update')->setMetas([
                'name'        => 'Update a role',
                'description' => 'Ability to update a role',
            ]),

            // admin::authorization.roles.activate
            $this->makeAbility('activate')->setMetas([
                'name'        => 'Activate a role',
                'description' => 'Ability to activate a role',
            ]),

            // admin::authorization.roles.deactivate
            $this->makeAbility('deactivate')->setMetas([
                'name'        => 'Deactivate a role',
                'description' => 'Ability to deactivate a role',
            ]),

            // admin::authorization.roles.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a role',
                'description' => 'Ability to delete a role',
            ]),

            // admin::authorization.roles.administrators.detach
            $this->makeAbility('administrators.detach', 'detachAdministrator')->setMetas([
                'name'        => 'Detach an administrator',
                'description' => 'Ability to detach the related administrator from role',
            ]),

            // admin::authorization.roles.permissions.detach
            $this->makeAbility('permissions.detach', 'detachPermission')->setMetas([
                'name'        => 'Detach a permission',
                'description' => 'Ability to detach the related permission from role',
            ]),
        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the roles.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function index(Administrator $administrator)
    {
        //
    }

    /**
     * Allow to show a role details.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role|null            $role
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(Administrator $administrator, Role $role = null)
    {
        if ($role && $role->isAdministrator() && ! $administrator->isSuperAdmin())
            return false;
    }

    /**
     * Allow to create a role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function create(Administrator $administrator)
    {
        //
    }

    /**
     * Allow to update a role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role|null            $role
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function update(Administrator $administrator, Role $role = null)
    {
        if (static::isRoleLocked($role))
            return false;
    }

    /**
     * Allow to activate a role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role|null            $role
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function activate(Administrator $administrator, Role $role = null)
    {
        if (static::isRoleLocked($role))
            return false;

        if ( ! is_null($role) && $role->isActive())
            return false;
    }

    /**
     * Allow to deactivate a role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role|null            $role
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function deactivate(Administrator $administrator, Role $role = null)
    {
        if (static::isRoleLocked($role))
            return false;

        if ( ! is_null($role) && ! $role->isActive())
            return false;
    }

    /**
     * Allow to delete a role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role|null            $role
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(Administrator $administrator, Role $role = null)
    {
        if ( ! is_null($role))
            return $role->isDeletable();
    }

    /**
     * Allow to detach a user from a role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role|null            $role
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function detachAdministrator(Administrator $administrator, Role $role = null, Administrator $model = null)
    {
        if ( ! $administrator->isSuperAdmin() && $model->isSuperAdmin())
            return false;
    }

    /**
     * Allow to detach a permission from a role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role|null            $role
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission|null      $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function detachPermission(Administrator $administrator, Role $role = null, Permission $model = null)
    {
        if (static::isRoleLocked($role))
            return false;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the role is locked.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role|null  $role
     *
     * @return bool
     */
    protected static function isRoleLocked(Role $role = null): bool
    {
        return ! is_null($role) && $role->isLocked();
    }
}
