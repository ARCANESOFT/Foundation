<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Roles\Permissions;

use Arcanesoft\Foundation\Authorization\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Authorization\Models\Role;

/**
 * Class     AttachingPermission
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AttachingPermission extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Authorization\Models\Permission|int */
    public $permission;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AttachingPermissionToRole constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role      $role
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role|int  $permission
     */
    public function __construct(Role $role, $permission)
    {
        parent::__construct($role);

        $this->permission = $permission;
    }
}
