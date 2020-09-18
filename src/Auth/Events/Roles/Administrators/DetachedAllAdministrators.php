<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles\Administrators;

use Arcanesoft\Foundation\Auth\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Auth\Models\Role;

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
     * @param  \Arcanesoft\Foundation\Auth\Models\Role  $role
     * @param  int                                      $detached
     */
    public function __construct(Role $role, $detached)
    {
        parent::__construct($role);

        $this->detached = $detached;
    }
}
