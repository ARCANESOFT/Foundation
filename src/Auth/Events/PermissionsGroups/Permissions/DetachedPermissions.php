<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions;

use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\PermissionsGroupEvent;
use Arcanesoft\Foundation\Auth\Models\PermissionsGroup;

/**
 * Class     DetachedPermissions
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedPermissions extends PermissionsGroupEvent
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
     * DetachedPermissionsFromGroup constructor.
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
