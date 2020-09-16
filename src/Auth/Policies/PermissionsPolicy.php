<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Policies;

use Arcanesoft\Foundation\Auth\Models\{Administrator, Permission, Role};

/**
 * Class     PermissionsPolicy
 *
 * @package  Arcanesoft\Foundation\Policies\Auth
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsPolicy extends AbstractPolicy
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
        return 'admin::auth.permissions.';
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
            'category' => 'Permissions',
        ]);

        return [

            // auth.permissions.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the permissions',
                'description' => 'Ability to list all the permissions',
            ]),

            // auth.permissions.show
            $this->makeAbility('show')->setMetas([
                'name'         => 'Show a permission',
                'description'  => "Ability to show the permission's details",
            ]),

            // auth.permissions.roles.detach
            $this->makeAbility('roles.detach', 'detachRole')->setMetas([
                'name'         => 'Detach a role from permission',
                'description'  => 'Ability to detach the related role from permission',
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
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|mixed  $administrator
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
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission|mixed     $permission
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(Administrator $administrator, Permission $permission = null)
    {
        //
    }

    /**
     * Allow to show a role details.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission|mixed     $permission
     * @param  \Arcanesoft\Foundation\Auth\Models\Role|mixed           $role
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function detachRole(Administrator $administrator, Permission $permission = null, Role $role = null)
    {
        if ( ! is_null($role))
            return ! $role->isLocked();
    }
}
