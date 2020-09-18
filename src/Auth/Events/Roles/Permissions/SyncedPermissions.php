<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles\Permissions;

use Arcanesoft\Foundation\Auth\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Class     SyncedPermissions
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SyncedPermissions extends RoleEvent
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

    /**
     * The synced result.
     *
     * @var array
     */
    public $synced;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * RoleEvent constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role  $role
     * @param  array                                    $ids
     * @param  array                                    $synced
     */
    public function __construct(Role $role, array $ids, array $synced)
    {
        parent::__construct($role);

        $this->ids    = $ids;
        $this->synced = $synced;
    }
}
