<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Repositories;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Events\Users\ActivatedUser;
use Arcanesoft\Foundation\Authorization\Events\Users\ActivatingUser;
use Arcanesoft\Foundation\Authorization\Events\Users\Attributes\UpdatedPassword;
use Arcanesoft\Foundation\Authorization\Events\Users\Attributes\UpdatingPassword;
use Arcanesoft\Foundation\Authorization\Events\Users\DeactivatedUser;
use Arcanesoft\Foundation\Authorization\Events\Users\DeactivatingUser;
use Arcanesoft\Foundation\Authorization\Models\User;
use Arcanesoft\Foundation\Authorization\Repositories\Concerns\Authentication\HasTwoFactorAuthentication;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Class     UsersRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @mixin  \Arcanesoft\Foundation\Authorization\Models\User
 */
class UsersRepository extends Repository
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
        return Auth::model('user', User::class);
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
     * @return \Arcanesoft\Foundation\Authorization\Models\User|\Illuminate\Database\Eloquent\Builder
     */
    public function onlyTrashed(bool $condition = true)
    {
        return $this->when($condition, function (Builder $query) {
            return $query->onlyTrashed();
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
     * @return \Arcanesoft\Foundation\Authorization\Models\User|mixed
     */
    public function firstWhereUuidOrFail(string $uuid): User
    {
        return $this->where('uuid', '=', $uuid)
                    ->withTrashed() // Get also trashed records
                    ->firstOrFail();
    }

    /**
     * Create a new user.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Authorization\Models\User
     */
    public function createOne(array $attributes): User
    {
        if ( ! array_key_exists('password', $attributes)) {
            $attributes['password'] = Str::random(8);
        }

        return tap($this->model()->fill($attributes), function (User $user) use ($attributes) {
            $user->forceFill([
                'uuid'         => $attributes['uuid'] ?? Str::uuid(),
                'activated_at' => $attributes['activated_at'] ?? now(), // TODO: Add a setting to change this
            ]);

            $user->save();
        });
    }

    /**
     * Update the given user (+ synced roles).
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User  $user
     * @param  array                                             $attributes
     *
     * @return bool
     *
     * @TODO: Clean this method.
     */
    public function updateOne(User $user, array $attributes): bool
    {
        $user->fill($attributes);

        $dirtyAttributes = $user->getDirty();

        $this->dispatchAttributeEvent('updating', $user, $dirtyAttributes);
        $updated = $user->save();
        $this->dispatchAttributeEvent('updated', $user, $dirtyAttributes);

        return $updated;
    }

    /**
     * TODO: Move this into a model or repository.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string                               $type
     *
     * @return array|null
     */
    protected function dispatchAttributeEvent(string $type, $model, $dirtyAttributes)
    {
        $attributesEvents = [
            'email.updating' => \Arcanesoft\Foundation\Authorization\Events\Users\Attributes\UpdatingEmail::class,
            'email.updated'  => \Arcanesoft\Foundation\Authorization\Events\Users\Attributes\UpdatedEmail::class,
        ];

        foreach ($dirtyAttributes as $name => $value) {
            $event = $name.'.'.$type;

            if ( ! array_key_exists($event, $attributesEvents))
                continue;

            return in_array($name, $model->getHidden())
                ? event(new $attributesEvents[$event]($model))
                : event(new $attributesEvents[$event]($model, $model->getOriginal($name)));
        }

        return null;
    }

    /**
     * Update the user's password.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User  $user
     * @param  string                                            $password
     *
     * @return bool
     */
    public function updatePassword(User $user, string $password): bool
    {
        event(new UpdatingPassword($user));

        $user->setRememberToken(Str::random(60));
        $updated = $this->updateOne($user, ['password' => $password]);

        event(new UpdatedPassword($user));

        return $updated;
    }

    /**
     * Activate/Deactivate a user.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User  $user
     *
     * @return bool
     */
    public function toggleActive(User $user): bool
    {
        return $user->isActive()
            ? $this->deactivateOne($user)
            : $this->activateOne($user);
    }

    /**
     * Activate the given user.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User  $user
     *
     * @return bool
     */
    public function activateOne(User $user)
    {
        if ($user->isActive())
            return false;

        event(new ActivatingUser($user));
        $result = $user->forceFill(['activated_at' => $user->freshTimestamp()])->save();
        event(new ActivatedUser($user));

        return $result;
    }

    /**
     * Deactivate the given user.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User  $user
     *
     * @return bool
     */
    public function deactivateOne(User $user): bool
    {
        if ( ! $user->isActive())
            return false;

        event(new DeactivatingUser($user));
        $result = $user->forceFill(['activated_at' => null])->save();
        event(new DeactivatedUser($user));

        return $result;
    }

    /**
     * Delete or Force delete a user if trashed.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User  $user
     *
     * @return bool|null
     */
    public function deleteOne(User $user)
    {
        return $user->trashed() ? $user->forceDelete() : $user->delete();
    }

    /**
     * Restore a user.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User  $user
     *
     * @return bool|null
     */
    public function restoreOne(User $user)
    {
        if ( ! $user->trashed())
            return null;

        return $user->restore();
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
}
