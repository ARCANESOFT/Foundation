<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Repositories;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Events\Administrators\ActivatedAdministrator;
use Arcanesoft\Foundation\Auth\Events\Administrators\ActivatingAdministrator;
use Arcanesoft\Foundation\Auth\Events\Administrators\Attributes\UpdatedPassword;
use Arcanesoft\Foundation\Auth\Events\Administrators\Attributes\UpdatingPassword;
use Arcanesoft\Foundation\Auth\Events\Administrators\DeactivatedAdministrator;
use Arcanesoft\Foundation\Auth\Events\Administrators\DeactivatingAdministrator;
use Arcanesoft\Foundation\Auth\Events\Administrators\Roles\SyncedRoles;
use Arcanesoft\Foundation\Auth\Events\Administrators\Roles\SyncingRoles;
use Arcanesoft\Foundation\Auth\Models\Administrator;
use Arcanesoft\Foundation\Auth\Repositories\Concerns\Authentication\HasTwoFactorAuthentication;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\{Collection, Str};

/**
 * Class     AdministratorsRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @mixin \Arcanesoft\Foundation\Auth\Models\Administrator
 */
class AdministratorsRepository extends AbstractRepository
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasTwoFactorAuthentication;

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
        return Auth::model('admin', Administrator::class);
    }

    /* -----------------------------------------------------------------
     |  Queries
     | -----------------------------------------------------------------
     */

    /**
     * Add a uuid where clause to the query.
     *
     * @param  string  $value
     *
     * @return \Illuminate\Database\Eloquent\Builder|mixed
     */
    public function whereUuid(string $value)
    {
        return $this->where('uuid', '=', $value);
    }

    /**
     * Scope only the trashed records.
     *
     * @param  bool  $condition
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Administrator|\Illuminate\Database\Eloquent\Builder
     */
    public function onlyTrashed(bool $condition = true)
    {
        return $this->when($condition, function (Builder $q) {
            return $q->onlyTrashed();
        });
    }

    /* -----------------------------------------------------------------
     |  CRUD Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the first user with the given uuid, or fails if not found.
     *
     * @param  string  $uuid
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Administrator|mixed
     */
    public function firstWhereUuidOrFail(string $uuid): Administrator
    {
        return $this
            ->where('uuid', '=', $uuid)
            ->withTrashed() // Get also trashed records
            ->firstOrFail();
    }

    /**
     * Create a new administrator.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Administrator|mixed
     */
    public function createOne(array $attributes): Administrator
    {
        $attributes['password'] = $attributes['password'] ?? Str::random(8);

        return tap($this->model()->fill($attributes), function (Administrator $administrator) use ($attributes) {
            $administrator->forceFill([
                'activated_at' => $attributes['activated_at'] ?? now(), // TODO: Add a setting to change this
            ]);

            $administrator->save();
        });
    }

    /**
     * Create a new administrator with roles.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Administrator|mixed
     */
    public function createOneWithRoles(array $attributes): Administrator
    {
        $roles = $attributes['roles'];

        return tap($this->createOne($attributes), function ($administrator) use ($roles) {
            $this->syncRolesByUuids($administrator, $roles);
        });
    }

    /**
     * Update the given administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     * @param  array                                             $attributes
     *
     * @return bool
     */
    public function updateOne(Administrator $administrator, array $attributes): bool
    {
        if ( ! $administrator->exists)
            return false;

        return $administrator->fill($attributes)->save();
    }

    /**
     * Update the given administrator with roles.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     * @param  array                                             $attributes
     *
     * @return bool
     */
    public function updateOneWithRoles(Administrator $administrator, array $attributes): bool
    {
        $roles = $attributes['roles'];

        return tap($this->updateOne($administrator, $attributes), function () use ($administrator, $roles) {
            $this->syncRolesByUuids($administrator, $roles);
        });
    }

    /**
     * Update the administrator's password.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     * @param  string                                            $password
     *
     * @return bool
     */
    public function updatePassword(Administrator $administrator, string $password)
    {
        event(new UpdatingPassword($administrator));
        $updated = $this->updateOne($administrator, compact('password'));
        event(new UpdatedPassword($administrator));

        return $updated;
    }

    /**
     * Activate/Deactivate a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     *
     * @return bool
     */
    public function toggleActive(Administrator $administrator): bool
    {
        return $administrator->isActive()
            ? $this->deactivate($administrator)
            : $this->activate($administrator);
    }

    /**
     * Activate the given user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     *
     * @return bool
     */
    public function activate(Administrator $administrator)
    {
        if ($administrator->isActive())
            return false;

        event(new ActivatingAdministrator($administrator));
        $result = $administrator->forceFill(['activated_at' => $administrator->freshTimestamp()])->save();
        event(new ActivatedAdministrator($administrator));

        return $result;
    }

    /**
     * Deactivate the given user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     *
     * @return bool
     */
    public function deactivate(Administrator $administrator): bool
    {
        if ( ! $administrator->isActive())
            return false;

        event(new DeactivatingAdministrator($administrator));
        $result = $administrator->forceFill(['activated_at' => null])->save();
        event(new DeactivatedAdministrator($administrator));

        return $result;
    }

    /**
     * Delete or Force delete a user if trashed.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     *
     * @return bool|null
     */
    public function deleteOne(Administrator $administrator)
    {
        return $administrator->trashed() ? $administrator->forceDelete() : $administrator->delete();
    }

    /**
     * Restore a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     *
     * @return bool|null
     */
    public function restoreOne(Administrator $administrator)
    {
        return $administrator->restore();
    }

    /**
     * Sync roles by keys.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|mixed  $administrator
     * @param  array                                                   $keys
     *
     * @return array
     */
    public function syncRolesByKeys(Administrator $administrator, array $keys): array
    {
        return $this->syncRoles(
            $administrator, $this->getRolesRepository()->getByKeys($keys)
        );
    }

    /**
     * Sync roles by uuids.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     * @param  array                                             $uuids
     *
     * @return array
     */
    public function syncRolesByUuids(Administrator $administrator, array $uuids): array
    {
        $roles = $this->getRolesRepository()->getByUuids($uuids);

        return $this->syncRoles($administrator, $roles);
    }

    /**
     * Sync roles with the user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     * @param  \Illuminate\Support\Collection                    $roles
     *
     * @return array
     */
    public function syncRoles(Administrator $administrator, Collection $roles): array
    {
        if (empty($roles))
            return [];

        event(new SyncingRoles($administrator, $roles));
        $synced = $administrator->roles()->sync($roles->pluck('id'));
        event(new SyncedRoles($administrator, $roles, $synced));

        return $synced;
    }

    /* -----------------------------------------------------------------
     |  Count Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the active users count.
     *
     * @return int
     */
    public function activeCount(): int
    {
        return $this->activated()->count();
    }

    /**
     * Get the verified users count.
     *
     * @return int
     */
    public function verifiedCount(): int
    {
        return $this->verifiedEmail()->count();
    }

    /**
     * Get the trashed users count.
     *
     * @return int
     */
    public function trashedCount(): int
    {
        return $this->onlyTrashed()->count();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the roles repository.
     *
     * @return \Arcanesoft\Foundation\Auth\Repositories\RolesRepository|mixed
     */
    protected function getRolesRepository(): RolesRepository
    {
        return static::makeRepository(RolesRepository::class);
    }
}
