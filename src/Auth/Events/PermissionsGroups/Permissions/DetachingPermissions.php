<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions;

use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\PermissionsGroupEvent;
use Arcanesoft\Foundation\Auth\Models\PermissionsGroup;

/**
 * Class     DetachingPermissionsFromGroup
 *
 * @package  Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions
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
     * @param  \Arcanesoft\Foundation\Auth\Models\PermissionsGroup  $group
     * @param  array                                                $permissionIds
     */
    public function __construct(PermissionsGroup $group, array $permissionIds)
    {
        parent::__construct($group);

        $this->permissionIds = $permissionIds;
    }
}
