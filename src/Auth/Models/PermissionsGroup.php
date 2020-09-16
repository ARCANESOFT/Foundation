<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\CreatedPermissionsGroup;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\CreatingPermissionsGroup;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\DeletedPermissionsGroup;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\DeletingPermissionsGroup;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions\AttachedPermission;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions\AttachedPermissions;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions\AttachingPermission;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions\AttachingPermissions;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions\DetachedAllPermissions;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions\DetachedPermission;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions\DetachedPermissions;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions\DetachingAllPermissions;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions\DetachingPermission;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions\DetachingPermissions;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\SavedPermissionsGroup;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\SavingPermissionsGroup;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\UpdatedPermissionsGroup;
use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\UpdatingPermissionsGroup;
use Illuminate\Support\Str;

/**
 * Class     PermissionsGroup
 *
 * @package  Arcanesoft\Foundation\Auth\Models
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int                                       id
 * @property  string                                    name
 * @property  string                                    slug
 * @property  string                                    description
 * @property  \Illuminate\Support\Carbon                created_at
 * @property  \Illuminate\Support\Carbon                updated_at
 *
 * @property  \Illuminate\Database\Eloquent\Collection  permissions
 */
class PermissionsGroup extends Model
{
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
        'slug',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating' => CreatingPermissionsGroup::class,
        'created'  => CreatedPermissionsGroup::class,
        'updating' => UpdatingPermissionsGroup::class,
        'updated'  => UpdatedPermissionsGroup::class,
        'saving'   => SavingPermissionsGroup::class,
        'saved'    => SavedPermissionsGroup::class,
        'deleting' => DeletingPermissionsGroup::class,
        'deleted'  => DeletedPermissionsGroup::class,
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
        $this->setTable(Auth::table('permissions-groups', 'permissions_groups'));

        parent::__construct($attributes);
    }

    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * Permissions Groups has many permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany(
            Auth::model('permission', Permission::class),
            'group_id'
        );
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the name attribute.
     *
     * @param  string  $name
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->setSlugAttribute($name);
    }

    /**
     * Set the slug attribute.
     *
     * @param  string  $slug
     */
    public function setSlugAttribute($slug)
    {
        $this->attributes['slug'] = Str::slug($slug, '-');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create and attach a permission.
     *
     * @param  array  $attributes
     * @param  bool   $reload
     */
    public function createPermission(array $attributes, bool $reload = true)
    {
        $this->permissions()->create($attributes);

        $this->loadPermissions($reload);
    }

    /**
     * Attach the permission to a group.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission  $permission
     * @param  bool                                           $reload
     */
    public function attachPermission(&$permission, bool $reload = true)
    {
        if ($this->hasPermission($permission))
            return;

        event(new AttachingPermission($this, $permission));
        $permission = $this->permissions()->save($permission);
        event(new AttachedPermission($this, $permission));

        $this->loadPermissions($reload);
    }

    /**
     * Attach the permission by id to a group.
     *
     * @param  int   $id
     * @param  bool  $reload
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Permission|null
     */
    public function attachPermissionById($id, bool $reload = true)
    {
        $permission = $this->getPermissionById($id);

        if ($permission !== null)
            $this->attachPermission($permission, $reload);

        return $permission;
    }

    /**
     * Attach a collection of permissions to the group.
     *
     * @param  \iterable  $permissions
     * @param  bool       $reload
     *
     * @return \iterable
     */
    public function attachPermissions($permissions, bool $reload = true): iterable
    {
        event(new AttachingPermissions($this, $permissions));
        $permissions = $this->permissions()->saveMany($permissions);
        event(new AttachedPermissions($this, $permissions));

        $this->loadPermissions($reload);

        return $permissions;
    }

    /**
     * Attach the permission from a group.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission  $permission
     * @param  bool                                           $reload
     */
    public function detachPermission(&$permission, bool $reload = true)
    {
        if ( ! $this->hasPermission($permission))
            return;

        $permission = $this->getPermissionFromGroup($permission);

        event(new DetachingPermission($this, $permission));
        $permission->update(['group_id' => 0]);
        event(new DetachedPermission($this, $permission));

        $this->loadPermissions($reload);
    }

    /**
     * Attach the permission by id to a group.
     *
     * @param  int   $id
     * @param  bool  $reload
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Permission
     */
    public function detachPermissionById($id, bool $reload = true)
    {
        if ( ! is_null($permission = $this->getPermissionById($id)))
            $this->detachPermission($permission, $reload);

        return $permission;
    }

    /**
     * Detach multiple permissions by ids.
     *
     * @param  array  $ids
     * @param  bool   $reload
     */
    public function detachPermissions(array $ids, bool $reload = true)
    {
        event(new DetachingPermissions($this, $ids));
        $this->permissions()->whereIn('id', $ids)->update(['group_id' => 0]);
        event(new DetachedPermissions($this, $ids));

        $this->loadPermissions($reload);
    }

    /**
     * Detach all permissions from the group.
     *
     * @param  bool  $reload
     */
    public function detachAllPermissions(bool $reload = true)
    {
        event(new DetachingAllPermissions($this));
        $this->permissions()->update(['group_id' => 0]);
        event(new DetachedAllPermissions($this));

        $this->loadPermissions($reload);
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if role has the given permission (Permission Model or Id).
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission|int  $id
     *
     * @return bool
     */
    public function hasPermission($id)
    {
        if ($id instanceof Model)
            $id = $id->getKey();

        return $this->getPermissionFromGroup($id) !== null;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get a permission from the group.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission|int  $id
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Permission|null
     */
    private function getPermissionFromGroup($id)
    {
        if ($id instanceof Model)
            $id = $id->getKey();

        $this->loadPermissions();

        return $this->permissions
            ->filter(function (Permission $permission) use ($id) {
                return $permission->getKey() == $id;
            })
            ->first();
    }

    /**
     * Get a permission by id.
     *
     * @param  int  $id
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Permission|mixed
     */
    private function getPermissionById($id)
    {
        return $this->permissions()
            ->getRelated()
            ->newQuery()
            ->where('id', $id)
            ->first();
    }

    /**
     * Load the permissions.
     *
     * @param  bool  $load
     *
     * @return self
     */
    protected function loadPermissions($load = true)
    {
        return $load ? $this->load('permissions') : $this;
    }
}
