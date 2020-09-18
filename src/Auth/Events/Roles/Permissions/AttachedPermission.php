<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles\Permissions;

use Arcanesoft\Foundation\Auth\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Class     AttachedPermission
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AttachedPermission extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Permission|int */
    public $permission;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AttachedPermissionToRole constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role      $role
     * @param  \Arcanesoft\Foundation\Auth\Models\Role|int  $permission
     */
    public function __construct(Role $role, $permission)
    {
        parent::__construct($role);

        $this->permission = $permission;
    }
}
