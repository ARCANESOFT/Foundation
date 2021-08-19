<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Permissions\Roles;

use Arcanesoft\Foundation\Authorization\Events\Permissions\PermissionEvent;
use Arcanesoft\Foundation\Authorization\Models\Permission;

/**
 * Class     DetachedAllRoles
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedAllRoles extends PermissionEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  int */
    public $results;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachedAllRolesFromPermission constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission  $permission
     * @param  int                                            $results
     */
    public function __construct(Permission $permission, $results)
    {
        parent::__construct($permission);

        $this->results = $results;
    }
}
