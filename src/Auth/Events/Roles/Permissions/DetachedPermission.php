<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles\Permissions;

use Arcanesoft\Foundation\Auth\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Class     DetachedPermission
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Roles\Permissions
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedPermission extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Permission|int */
    public $permission;

    /** @var  int */
    public $detached;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachedPermissionFromRole constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role            $role
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission|int  $permission
     * @param  int                                                $detached
     */
    public function __construct(Role $role, $permission, $detached)
    {
        parent::__construct($role);

        $this->permission = $permission;
        $this->detached   = $detached;
    }
}
