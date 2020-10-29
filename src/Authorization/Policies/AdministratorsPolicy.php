<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Policies;

use Arcanesoft\Foundation\Authorization\Models\Administrator;

/**
 * Class     AdministratorsPolicy
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdministratorsPolicy extends AbstractPolicy
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
        return 'admin::authorization.administrators.';
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
            'category' => 'Administrators',
        ]);

        return [

            // admin::authorization.administrators.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the administrators',
                'description' => 'Ability to list all the administrators',
            ]),

            // admin::authorization.administrators.metrics
            $this->makeAbility('metrics')->setMetas([
                'name'        => 'Show the metrics',
                'description' => "Ability to show the administrator's metrics",
            ]),

            // admin::authorization.administrators.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show an administrator',
                'description' => "Ability to show the administrator's details",
            ]),

            // admin::authorization.administrators.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new administrator',
                'description' => 'Ability to create a new administrator',
            ]),

            // admin::authorization.administrators.update
            $this->makeAbility('update')->setMetas([
                'name'        => 'Update a administrator',
                'description' => 'Ability to update a administrator',
            ]),

            // admin::authorization.administrators.activate
            $this->makeAbility('activate')->setMetas([
                'name'        => 'Activate an administrator',
                'description' => 'Ability to deactivate a administrator',
            ]),

            // admin::authorization.administrators.deactivate
            $this->makeAbility('deactivate')->setMetas([
                'name'        => 'Deactivate an administrator',
                'description' => 'Ability to deactivate an administrator',
            ]),

            // admin::authorization.administrators.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a administrator',
                'description' => 'Ability to delete a administrator',
            ]),

            // admin::authorization.administrators.force-delete
            $this->makeAbility('force-delete')->setMetas([
                'name'        => 'Force Delete a administrator',
                'description' => 'Ability to force delete a administrator',
            ]),

            // admin::authorization.administrators.restore
            $this->makeAbility('restore')->setMetas([
                'name'        => 'Restore a administrator',
                'description' => 'Ability to restore a administrator',
            ]),
        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the administrators.
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
     * Allow to list all the administrators' metrics.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function metrics(Administrator $administrator)
    {
        //
    }

    /**
     * Allow to show a administrator details.
     *
     * @param \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param \Arcanesoft\Foundation\Authorization\Models\Administrator|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(Administrator $administrator, Administrator $model = null)
    {
        if ($model && $model->isSuperAdmin() && ! $administrator->isSuperAdmin())
            return false;
    }

    /**
     * Allow to create a administrator.
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
     * Allow to update a administrator.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function update(Administrator $administrator, Administrator $model = null)
    {
        //
    }

    /**
     * Allow to activate an administrator.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function activate(Administrator $administrator, Administrator $model = null)
    {
        if ( ! is_null($model) && $model->isActive())
            return false;

        if ($administrator->is($model))
            return false;

        if ( ! is_null($model) && $model->isSuperAdmin())
            return false;
    }

    /**
     * Allow to deactivate an administrator.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function deactivate(Administrator $administrator, Administrator $model = null)
    {
        if ( ! is_null($model) && ! $model->isActive())
            return false;

        if ($administrator->is($model))
            return false;

        if ( ! is_null($model) && $model->isSuperAdmin())
            return false;
    }

    /**
     * Allow to delete a administrator.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(Administrator $administrator, Administrator $model = null)
    {
        if ($administrator->is($model))
            return false;

        if ( ! is_null($model))
            return $model->isDeletable();
    }

    /**
     * Allow to force delete a administrator.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function forceDelete(Administrator $administrator, Administrator $model = null)
    {
        if ( ! is_null($model))
            return $model->isDeletable();
    }

    /**
     * Allow to restore a administrator.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function restore(Administrator $administrator, Administrator $model = null)
    {
        if ( ! is_null($model))
            return $model->trashed();
    }
}
