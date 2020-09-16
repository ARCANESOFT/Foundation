<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles\Administrators;

use Arcanesoft\Foundation\Auth\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Class     DetachedAdministrator
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Roles\Administrators
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedAdministrator extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Administrator|int */
    public $administrator;

    /** @var  int */
    public $detached;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachedAdministrator constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role               $role
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|int  $administrator
     * @param  int                                                   $detached
     */
    public function __construct(Role $role, $administrator, $detached)
    {
        parent::__construct($role);

        $this->administrator = $administrator;
        $this->detached      = $detached;
    }
}
