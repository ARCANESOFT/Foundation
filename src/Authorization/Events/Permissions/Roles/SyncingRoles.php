<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Permissions\Roles;

use Arcanesoft\Foundation\Authorization\Events\Permissions\PermissionEvent;
use Arcanesoft\Foundation\Authorization\Models\Permission;
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
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission  $permission
     * @param  \Illuminate\Database\Eloquent\Collection       $roles
     */
    public function __construct(Permission $permission, Collection $roles)
    {
        parent::__construct($permission);

        $this->roles = $roles;
    }
}
