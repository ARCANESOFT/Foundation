<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Roles\Administrators;

use Arcanesoft\Foundation\Authorization\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Authorization\Models\Role;

/**
 * Class     DetachedAdministrator
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedAdministrator extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Authorization\Models\Administrator|int */
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
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role               $role
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|int  $administrator
     * @param  int                                                   $detached
     */
    public function __construct(Role $role, $administrator, $detached)
    {
        parent::__construct($role);

        $this->administrator = $administrator;
        $this->detached      = $detached;
    }
}
