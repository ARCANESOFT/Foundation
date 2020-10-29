<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Roles\Permissions;

use Arcanesoft\Foundation\Authorization\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Authorization\Models\Role;

/**
 * Class     DetachedAllPermissions
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedAllPermissions extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  int */
    public $detached;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachedAllPermissionsFromRole constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role  $role
     * @param  int                                      $detached
     */
    public function __construct(Role $role, $detached)
    {
        parent::__construct($role);

        $this->detached = $detached;
    }
}
