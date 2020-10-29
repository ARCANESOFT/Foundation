<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Roles\Permissions;

use Arcanesoft\Foundation\Authorization\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Authorization\Models\Role;

/**
 * Class     DetachedPermission
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedPermission extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Authorization\Models\Permission|int */
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
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role            $role
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission|int  $permission
     * @param  int                                                $detached
     */
    public function __construct(Role $role, $permission, $detached)
    {
        parent::__construct($role);

        $this->permission = $permission;
        $this->detached   = $detached;
    }
}
