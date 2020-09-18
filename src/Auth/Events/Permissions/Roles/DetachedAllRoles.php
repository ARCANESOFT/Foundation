<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Permissions\Roles;

use Arcanesoft\Foundation\Auth\Events\Permissions\PermissionEvent;
use Arcanesoft\Foundation\Auth\Models\Permission;

/**
 * Class     DetachedAllRoles
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedAllRoles extends PermissionEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  int */
    public $results;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachedAllRolesFromPermission constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission  $permission
     * @param  int                                            $results
     */
    public function __construct(Permission $permission, $results)
    {
        parent::__construct($permission);

        $this->results = $results;
    }
}
