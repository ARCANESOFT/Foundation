<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Roles\Administrators;

use Arcanesoft\Foundation\Authorization\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Authorization\Models\Role;

/**
 * Class     DetachedAllAdministrators
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedAllAdministrators extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  int */
    public $detached;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachedAllAdministrators constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role  $role
     * @param  int                                      $detached
     */
    public function __construct(Role $role, $detached)
    {
        parent::__construct($role);

        $this->detached = $detached;
    }
}
