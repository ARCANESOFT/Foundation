<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions;

use Arcanesoft\Foundation\Auth\Events\PermissionsGroups\PermissionsGroupEvent;
use Arcanesoft\Foundation\Auth\Models\PermissionsGroup;

/**
 * Class     AttachingPermissions
 *
 * @package  Arcanesoft\Foundation\Auth\Events\PermissionsGroups\Permissions
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AttachingPermissions extends PermissionsGroupEvent
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
     * AttachingPermissionsToGroup constructor.
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
