<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions;

use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\PermissionsGroupEvent;
use Arcanesoft\Foundation\Auth\Models\PermissionsGroup;

/**
 * Class     AttachedPermissions
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AttachedPermissions extends PermissionsGroupEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  iterable */
    public $permissions;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AttachedPermissionsToGroup constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\PermissionsGroup  $group
     * @param  iterable                                             $permissions
     */
    public function __construct(PermissionsGroup $group, iterable $permissions)
    {
        parent::__construct($group);

        $this->permissions = $permissions;
    }
}
