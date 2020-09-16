<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles\Permissions;

use Arcanesoft\Foundation\Auth\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Class     DetachingPermission
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Roles\Permissions
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachingPermission extends RoleEvent
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
     * DetachingPermissionFromRole constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role            $role
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission|int  $permission
     */
    public function __construct(Role $role, $permission)
    {
        parent::__construct($role);

        $this->permission = $permission;
    }
}
