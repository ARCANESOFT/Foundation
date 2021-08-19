<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Roles\Permissions;

use Arcanesoft\Foundation\Authorization\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Authorization\Models\Role;

/**
 * Class     DetachingPermission
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachingPermission extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Authorization\Models\Permission|int */
    public $permission;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachingPermissionFromRole constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role            $role
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission|int  $permission
     */
    public function __construct(Role $role, $permission)
    {
        parent::__construct($role);

        $this->permission = $permission;
    }
}
