<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\PermissionsGroups\Permissions;

use Arcanesoft\Foundation\Authorization\Events\PermissionsGroups\PermissionsGroupEvent;
use Arcanesoft\Foundation\Authorization\Models\PermissionsGroup;

/**
 * Class     DetachingPermissions
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachingPermissions extends PermissionsGroupEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  array */
    public $permissionIds;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachingPermissionsFromGroup constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\PermissionsGroup  $group
     * @param  array                                                $permissionIds
     */
    public function __construct(PermissionsGroup $group, array $permissionIds)
    {
        parent::__construct($group);

        $this->permissionIds = $permissionIds;
    }
}