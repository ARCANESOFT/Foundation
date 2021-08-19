<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Roles\Permissions;

use Arcanesoft\Foundation\Authorization\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Authorization\Models\Role;

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
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role  $role
     * @param  array                                    $ids
     */
    public function __construct(Role $role, array $ids)
    {
        parent::__construct($role);

        $this->ids = $ids;
    }
}
