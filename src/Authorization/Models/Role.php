<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Models;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Events\Roles\Administrators\AttachedAdministrator;
use Arcanesoft\Foundation\Authorization\Events\Roles\Administrators\AttachingAdministrator;
use Arcanesoft\Foundation\Authorization\Events\Roles\Administrators\DetachedAdministrator;
use Arcanesoft\Foundation\Authorization\Events\Roles\Administrators\DetachingAdministrator;
use Arcanesoft\Foundation\Authorization\Events\Roles\Permissions\AttachedPermission;
use Arcanesoft\Foundation\Authorization\Events\Roles\Permissions\AttachingPermission;
use Arcanesoft\Foundation\Authorization\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Authorization\Models\Concerns\Activatable;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class     Role
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int                                       id
 * @property  string                                    uuid
 * @property  string                                    name
 * @property  string                                    key
 * @property  string                                    description
 * @property  bool                                      is_locked
 * @property  \Illuminate\Support\Carbon                created_at
 * @property  \Illuminate\Support\Carbon                updated_at
 *
 * @property  \Arcanesoft\Foundation\Authorization\Models\Administrator[]|\Illuminate\Database\Eloquent\Collection  administrators
 * @property  \Arcanesoft\Foundation\Authorization\Models\Permission[]|\Illuminate\Database\Eloquent\Collection     permissions
 *
 * @method  static  \Illuminate\Database\Eloquent\Builder|static  admin()
 * @method  static  \Illuminate\Database\Eloquent\Builder|static  filterByAuthenticatedAdministrator(Administrator|mixed $administrator)
 */
class Role extends Model
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const ADMINISTRATOR = 'administrator';

    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use Activatable;

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
        'name',
        'key',
        'description',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = RoleEvent::MODEL_EVENTS;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'is_locked'    => 'boolean',
        'activated_at' => 'datetime',
    ];

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
        $this->setTable(Auth::table('roles'));

        parent::__construct($attributes);
    }

    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * Role belongs to many administrators.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function administrators()
    {
        return $this
            ->belongsToMany(
                Auth::model('administrator', Administrator::class),
                Auth::table('administrator-role', 'administrator_role')
            )
            ->using(Pivots\AdministratorRole::class)
            ->as('administrator_role')
            ->withPivot(['created_at']);
    }

    /**
     * Role belongs to many permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this
            ->belongsToMany(
                Auth::model('permission', Permission::class),
                Auth::table('permission-role', 'permission_role')
            )
            ->using(Pivots\PermissionRole::class)
            ->as('permission_role')
            ->withPivot(['created_at']);
    }

    /* -----------------------------------------------------------------
     |  Scopes
     | -----------------------------------------------------------------
     */

    /**
     * Scope by the authenticated user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder             $query
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator  $administrator
     *
     * @return \Illuminate\Database\Eloquent\Builder|mixed
     */
    public function scopeFilterByAuthenticatedAdministrator(Builder $query, Administrator $administrator): Builder
    {
        return $query->unless($administrator->isSuperAdmin(), function (Builder $q) {
            $q->where('key', '!=', static::ADMINISTRATOR);
        });
    }

    /**
     * Scope only with administrator role.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdmin(Builder $query): Builder
    {
        return $query->where('key', static::ADMINISTRATOR);
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
     * Set the name attribute.
     *
     * @param  string  $name
     */
    public function setNameAttribute(string $name)
    {
        $this->attributes['name'] = $name;

        $this->setKeyAttribute($name);
    }

    /**
     * Set the `key` attribute.
     *
     * @param  string  $key
     */
    public function setKeyAttribute(string $key)
    {
        $this->attributes['key'] = Auth::slugRoleKey($key);
    }

    /* ------------------------------------------------------------------------------------------------
     |  CRUD Functions
     | ------------------------------------------------------------------------------------------------
     */

    /**
     * Attach a permission to a role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|int  $administrator
     * @param  bool                                                  $reload
     */
    public function attachUser($administrator, bool $reload = true): void
    {
        if ($this->hasAdministrator($administrator))
            return;

        event(new AttachingAdministrator($this, $administrator));
        $this->administrators()->attach($administrator);
        event(new AttachedAdministrator($this, $administrator));

        $this->loadAdministrators($reload);
    }

    // TODO: Adding attach multiple users to a role ?

    /**
     * Detach a user from a role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|int  $administrator
     * @param  bool                                         $reload
     *
     * @return int
     */
    public function detachAdministrator($administrator, bool $reload = true): int
    {
        event(new DetachingAdministrator($this, $administrator));
        $results = $this->administrators()->detach($administrator);
        event(new DetachedAdministrator($this, $administrator, $results));

        $this->loadAdministrators($reload);

        return $results;
    }

    // TODO: Adding detach multiple administrators to a role ?

    /**
     * Attach a permission to a role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission|int  $permission
     * @param  bool                                               $reload
     */
    public function attachPermission($permission, bool $reload = true): void
    {
        if ($this->hasPermission($permission))
            return;

        event(new AttachingPermission($this, $permission));
        $this->permissions()->attach($permission);
        event(new AttachedPermission($this, $permission));

        $this->loadPermissions($reload);
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if role has the given user (User Model or Id).
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|int  $id
     *
     * @return bool
     */
    public function hasAdministrator($id): bool
    {
        $id = $id instanceof Model ? $id->getKey() : $id;

        return $this->administrators->contains('id', $id);
    }

    /**
     * Check if role has the given permission (Permission Model or Id).
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission|int  $id
     *
     * @return bool
     */
    public function hasPermission($id): bool
    {
        $id = $id instanceof Model ? $id->getKey() : $id;

        return $this->permissions->contains('id', $id);
    }

    /**
     * Check if role is associated with a permission by ability.
     *
     * @param  string  $ability
     *
     * @return bool
     */
    public function can(string $ability): bool
    {
        if ( ! $this->isActive())
            return false;

        return $this->permissions->filter(function (Permission $permission) use ($ability) {
            return $permission->hasAbility($ability);
        })->first() !== null;
    }

    /**
     * Check if a role is associated with any of given permissions.
     *
     * @param  \Illuminate\Support\Collection|array  $permissions
     * @param  \Illuminate\Support\Collection        &$failed
     *
     * @return bool
     */
    public function canAny($permissions, &$failed = null): bool
    {
        $permissions = is_array($permissions) ? collect($permissions) : $permissions;

        $failed = $permissions->reject(function ($permission) {
            return $this->can($permission);
        })->values();

        return $permissions->count() !== $failed->count();
    }

    /**
     * Check if role is associated with all given permissions.
     *
     * @param  \Illuminate\Support\Collection|array  $permissions
     * @param  \Illuminate\Support\Collection        &$failed
     *
     * @return bool
     */
    public function canAll($permissions, &$failed = null): bool
    {
        $this->canAny($permissions, $failed);

        return $failed->isEmpty();
    }

    /**
     * Check if the role is locked.
     *
     * @return bool
     */
    public function isLocked(): bool
    {
        return $this->is_locked;
    }

    /**
     * Check if key is the same as the given value.
     *
     * @param  string  $key
     *
     * @return bool
     */
    public function hasKey(string $key): bool
    {
        return $this->key === Auth::slugRoleKey($key);
    }

    /**
     * Check if the records is deletable.
     *
     * @return bool
     */
    public function isDeletable(): bool
    {
        return ! $this->isLocked();
    }

    /**
     * Check if the record is not deletable.
     *
     * @return bool
     */
    public function isNotDeletable(): bool
    {
        return ! $this->isDeletable();
    }

    /**
     * Check if the current role is an administrator one.
     *
     * @return bool
     */
    public function isAdministrator(): bool
    {
        return $this->key === static::ADMINISTRATOR;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Load the administrators.
     *
     * @param  bool  $load
     *
     * @return $this
     */
    protected function loadAdministrators(bool $load = true)
    {
        return $load ? $this->load('administrators') : $this;
    }

    /**
     * Load the permissions.
     *
     * @param  bool  $load
     *
     * @return $this
     */
    protected function loadPermissions(bool $load = true)
    {
        return $load ? $this->load('permissions') : $this;
    }
}
