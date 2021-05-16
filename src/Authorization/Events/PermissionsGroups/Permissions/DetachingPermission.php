<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\PermissionsGroups\Permissions;

use Arcanesoft\Foundation\Authorization\Events\PermissionsGroups\PermissionsGroupEvent;
use Arcanesoft\Foundation\Authorization\Models\{Permission, PermissionsGroup};

/**
 * Class     DetachingPermission
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachingPermission extends PermissionsGroupEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Authorization\Models\Permission */
    public $permission;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachingPermissionFromGroup constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\PermissionsGroup  $group
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission        $permission
     */
    public function __construct(PermissionsGroup $group, Permission $permission)
    {
        parent::__construct($group);

        $this->permission = $permission;
    }
}
