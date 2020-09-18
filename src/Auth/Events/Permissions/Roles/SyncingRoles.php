<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Permissions\Roles;

use Arcanesoft\Foundation\Auth\Events\Permissions\PermissionEvent;
use Arcanesoft\Foundation\Auth\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class     SyncingRoles
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SyncingRoles extends PermissionEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Illuminate\Database\Eloquent\Collection */
    public $roles;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * SyncingRolesToPermission constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission  $permission
     * @param  \Illuminate\Database\Eloquent\Collection       $roles
     */
    public function __construct(Permission $permission, Collection $roles)
    {
        parent::__construct($permission);

        $this->roles = $roles;
    }
}
