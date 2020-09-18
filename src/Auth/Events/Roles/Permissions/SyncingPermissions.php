<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles\Permissions;

use Arcanesoft\Foundation\Auth\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Class     SyncingPermissions
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SyncingPermissions extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Permissions' ids.
     *
     * @var array
     */
    public $ids;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * RoleEvent constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role  $role
     * @param  array                                    $ids
     */
    public function __construct(Role $role, array $ids)
    {
        parent::__construct($role);

        $this->ids = $ids;
    }
}
