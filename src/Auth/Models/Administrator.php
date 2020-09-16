<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models;

use Arcanedev\LaravelImpersonator\Contracts\Impersonatable;
use Arcanedev\LaravelImpersonator\Traits\CanImpersonate;
use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Contracts\CanBeActivated;
use Arcanesoft\Foundation\Auth\Events\Administrators\{AdministratorEvent};
use Arcanesoft\Foundation\Auth\Models\Concerns\Activatable;
use Arcanesoft\Foundation\Auth\Models\Concerns\CanResetPassword;
use Arcanesoft\Foundation\Auth\Models\Concerns\HasPassword;
use Arcanesoft\Foundation\Auth\Models\Concerns\HasRoles;
use Arcanesoft\Foundation\Auth\Models\Concerns\HasSessions;
use Arcanesoft\Foundation\Auth\Models\Concerns\HasTwoFactorAuthentication;
use Arcanesoft\Foundation\Auth\Models\Presenters\UserPresenter;
use Arcanesoft\Foundation\Authentication\Guard;
use Arcanesoft\Foundation\Fortify\Notifications\VerifyEmailNotification;
use Arcanesoft\Foundation\Support\Traits\Deletable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

/**
 * Class     Administrator
 *
 * @package  Arcanesoft\Foundation\Auth\Models
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int                              id
 * @property  string                           uuid
 * @property  string|null                      first_name
 * @property  string|null                      last_name
 * @property  string                           email
 * @property  string                           password
 * @property  string|null                      two_factor_secret
 * @property  string|null                      two_factor_recovery_codes
 * @property  string|null                      remember_token
 * @property  string|null                      avatar
 * @property  \Illuminate\Support\Carbon|null  last_activity_at
 * @property  \Illuminate\Support\Carbon       created_at
 * @property  \Illuminate\Support\Carbon       updated_at
 * @property  \Illuminate\Support\Carbon|null  activated_at
 * @property  \Illuminate\Support\Carbon|null  deleted_at
 *
 * @property  \Illuminate\Support\Collection|\Arcanesoft\Foundation\Auth\Models\Role[]        roles
 * @property  \Illuminate\Support\Collection|\Arcanesoft\Foundation\Auth\Models\Role[]        active_roles
 * @property  \Illuminate\Support\Collection|\Arcanesoft\Foundation\Auth\Models\Permission[]  permissions
 */
class Administrator extends Authenticatable implements Impersonatable, CanBeActivated
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use Activatable;
    use CanImpersonate;
    use CanResetPassword;
    use Deletable;
    use HasPassword;
    use HasSessions;
    use HasRoles;
    use HasFactory;
    use HasTwoFactorAuthentication;
    use Notifiable;
    use SoftDeletes;
    use UserPresenter;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'last_activity_at' => 'datetime',
        'activated_at'     => 'datetime',
        'two_factor'       => Casts\TwoFactorCast::class,
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = AdministratorEvent::MODEL_EVENTS;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setConnection(config('arcanesoft.auth.database.connection'));
        $this->setTable(Auth::table('administrators'));

        parent::__construct($attributes);
    }

    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * The roles' relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        $related = Auth::model('role', Role::class);
        $table   = Auth::table('administrator-role', 'administrator_role');

        return $this->belongsToMany($related, $table)
            ->using(Pivots\AdministratorRole::class)
            ->as('administrator_role')
            ->withPivot(['created_at']);
    }

    /**
     * Get all user's permissions (active roles).
     *
     * @return \Illuminate\Support\Collection
     */
    public function getPermissionsAttribute()
    {
        return $this->active_roles
            ->pluck('permissions')
            ->flatten()
            ->unique(function (Permission $permission) {
                return $permission->getKey();
            });
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * Get the guard's name.
     *
     * @return string
     */
    public static function guardName(): string
    {
        return Guard::WEB_ADMINISTRATOR;
    }

    /* -----------------------------------------------------------------
     |  Permission Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the user has a permission.
     *
     * @param  string  $ability
     *
     * @return bool
     */
    public function may($ability): bool
    {
        return $this->permissions->filter(function (Permission $permission) use ($ability) {
            return $permission->hasAbility($ability);
        })->isNotEmpty();
    }

    /**
     * Check if the user has at least one permission.
     *
     * @param  \Illuminate\Support\Collection|array  $permissions
     * @param  \Illuminate\Support\Collection|null   &$failed
     *
     * @return bool
     */
    public function mayOne($permissions, &$failed = null): bool
    {
        $permissions = $permissions instanceof Collection
            ? $permissions
            : $this->newCollection($permissions);

        $failed = $permissions->reject(function ($permission) {
            return $this->may($permission);
        })->values();

        return $permissions->count() !== $failed->count();
    }

    /**
     * Check if the user has all permissions.
     *
     * @param  \Illuminate\Support\Collection|array  $permissions
     * @param  \Illuminate\Support\Collection|null   &$failed
     *
     * @return bool
     */
    public function mayAll($permissions, &$failed = null): bool
    {
        $this->mayOne($permissions, $failed);

        return $failed instanceof Collection
            ? $failed->isEmpty()
            : false;
    }

    /**
     * Update the user's last activity.
     *
     * @return bool
     */
    public function updateLastActivity()
    {
        return $this->forceFill([
            'last_activity_at' => $this->freshTimestamp(),
        ])->save();
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the user is deletable.
     *
     * @return bool
     */
    public function isDeletable(): bool
    {
        return ! $this->isSuperAdmin()
            || ! $this->is(Auth::admin());
    }

    /**
     * Check if the current modal can impersonate other models.
     *
     * @return  bool
     */
    public function canImpersonate(): bool
    {
        if ( ! impersonator()->isEnabled())
            return false;

        return $this->isSuperAdmin();
    }

    /**
     * Check if the current model can be impersonated.
     *
     * @return  bool
     */
    public function canBeImpersonated(): bool
    {
        if ( ! impersonator()->isEnabled())
            return false;

        return false;
    }

    /**
     * Check if the user is a super admin.
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return Auth::isSuperAdmin($this);
    }

    /* -----------------------------------------------------------------
     |  Notifications
     | -----------------------------------------------------------------
     */

    /**
     * Send the email verification notification.
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new class extends VerifyEmailNotification {
            protected function getVerificationRoute(): string {
                return 'auth::admin.email.verification.verify';
            }
        });
    }
}
