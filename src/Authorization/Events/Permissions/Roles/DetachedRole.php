<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Permissions\Roles;

use Arcanesoft\Foundation\Authorization\Events\Permissions\PermissionEvent;
use Arcanesoft\Foundation\Authorization\Models\Permission;

/**
 * Class     DetachedRole
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedRole extends PermissionEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Authorization\Models\Role|int */
    public $role;

    /** @var  int */
    public $detached;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachingRoleFromPermission constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission  $permission
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role|int    $role
     * @param  int                                            $detached
     */
    public function __construct(Permission $permission, $role, $detached)
    {
        parent::__construct($permission);

        $this->role     = $role;
        $this->detached = $detached;
    }
}
