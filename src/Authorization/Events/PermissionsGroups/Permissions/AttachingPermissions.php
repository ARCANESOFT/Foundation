<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\PermissionsGroups\Permissions;

use Arcanesoft\Foundation\Authorization\Events\PermissionsGroups\PermissionsGroupEvent;
use Arcanesoft\Foundation\Authorization\Models\PermissionsGroup;

/**
 * Class     AttachingPermissions
 *
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
     * @param  \Arcanesoft\Foundation\Authorization\Models\PermissionsGroup  $group
     * @param  iterable                                             $permissions
     */
    public function __construct(PermissionsGroup $group, iterable $permissions)
    {
        parent::__construct($group);

        $this->permissions = $permissions;
    }
}
