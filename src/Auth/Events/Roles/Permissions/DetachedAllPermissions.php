<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles\Permissions;

use Arcanesoft\Foundation\Auth\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Class     DetachedAllPermissions
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Roles\Permissions
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
     * @param  \Arcanesoft\Foundation\Auth\Models\Role  $role
     * @param  int                                      $detached
     */
    public function __construct(Role $role, $detached)
    {
        parent::__construct($role);

        $this->detached = $detached;
    }
}
