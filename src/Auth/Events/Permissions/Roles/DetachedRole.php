<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Permissions\Roles;

use Arcanesoft\Foundation\Auth\Events\Permissions\PermissionEvent;
use Arcanesoft\Foundation\Auth\Models\Permission;

/**
 * Class     DetachedRole
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Permissions\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedRole extends PermissionEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Role|int */
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
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission  $permission
     * @param  \Arcanesoft\Foundation\Auth\Models\Role|int    $role
     * @param  int                                            $detached
     */
    public function __construct(Permission $permission, $role, $detached)
    {
        parent::__construct($permission);

        $this->role     = $role;
        $this->detached = $detached;
    }
}
