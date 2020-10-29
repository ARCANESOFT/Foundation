<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Permissions\Roles;

use Arcanesoft\Foundation\Authorization\Events\Permissions\PermissionEvent;
use Arcanesoft\Foundation\Authorization\Models\Permission;

/**
 * Class     AttachingRole
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AttachingRole extends PermissionEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Authorization\Models\Role|int */
    public $role;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AttachingRoleToPermission constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission  $permission
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role|int    $role
     */
    public function __construct(Permission $permission, $role)
    {
        parent::__construct($permission);

        $this->role = $role;
    }
}
