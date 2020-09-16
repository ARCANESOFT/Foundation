<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Policies;

use Arcanesoft\Foundation\Auth\Models\{Administrator, User};

/**
 * Class     UsersPolicy
 *
 * @package  Arcanesoft\Foundation\Auth\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersPolicy extends AbstractPolicy
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
        return 'admin::auth.users.';
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
            'category' => 'Users',
        ]);

        return [

            // admin::auth.users.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the users',
                'description' => 'Ability to list all the users'
            ]),

            // admin::auth.users.metrics
            $this->makeAbility('metrics')->setMetas([
                'name'        => 'Show the metrics',
                'description' => 'Ability to show the user\'s metrics',
            ]),

            // admin::auth.users.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show a user',
                'description' => 'Ability to show the user\'s details',
            ]),

            // admin::auth.users.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new user',
                'description' => 'Ability to create a new user',
            ]),

            // admin::auth.users.update
            $this->makeAbility('update')->setMetas([
                'name'        => 'Update a user',
                'description' => 'Ability to update a user',
            ]),

            // admin::auth.users.activate
            $this->makeAbility('activate')->setMetas([
                'name'        => 'Activate/Deactivate a user',
                'description' => 'Ability to activate/deactivate a user',
            ]),

            // admin::auth.users.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a user',
                'description' => 'Ability to delete a user',
            ]),

            // admin::auth.users.force-delete
            $this->makeAbility('force-delete')->setMetas([
                'name'        => 'Force Delete a user',
                'description' => 'Ability to force delete a user',
            ]),

            // admin::auth.users.restore
            $this->makeAbility('restore')->setMetas([
                'name'        => 'Restore a user',
                'description' => 'Ability to restore a user',
            ]),

            // admin::auth.users.impersonate
            $this->makeAbility('impersonate')->setMetas([
                'name'        => 'Impersonate a user',
                'description' => 'Ability to impersonate a user',
            ]),

            $this->makeAbility('verify')->setMetas([
                'name'        => 'Verify a user',
                'description' => "Ability to verify a user's email address",
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the users.
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
     * Allow to show the user's metrics.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function metrics(Administrator $administrator)
    {
        //
    }

    /**
     * Allow to show a user details.
     *
     * @param \Arcanesoft\Foundation\Auth\Models\Administrator|mixed  $administrator
     * @param \Arcanesoft\Foundation\Auth\Models\User|null            $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(Administrator $administrator, User $user = null)
    {
        //
    }

    /**
     * Allow to create a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function create(Administrator $administrator)
    {
        //
    }

    /**
     * Allow to update a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Auth\Models\User|null            $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function update(Administrator $administrator, User $user = null)
    {
        //
    }

    /**
     * Allow to update a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Auth\Models\User|null            $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function activate(Administrator $administrator, User $user = null)
    {
        //
    }

    /**
     * Allow to delete a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Auth\Models\User|null            $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(Administrator $administrator, User $user = null)
    {
        if ( ! is_null($user))
            return $user->isDeletable();
    }

    /**
     * Allow to force delete a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Auth\Models\User|null            $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function forceDelete(Administrator $administrator, User $user = null)
    {
        if ( ! is_null($user))
            return $user->isDeletable();
    }

    /**
     * Allow to restore a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Auth\Models\User|null            $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function restore(Administrator $administrator, User $user = null)
    {
        if ( ! is_null($user)) {
            return $user->trashed();
        }
    }

    /**
     * Allow to impersonate a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Auth\Models\User|null            $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function impersonate(Administrator $administrator, User $user)
    {
        //
    }

    public function verify(Administrator $administrator, User $user)
    {
        //
    }
}
