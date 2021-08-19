<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Roles\Administrators;

use Arcanesoft\Foundation\Authorization\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Authorization\Models\Role;

/**
 * Class     AttachingAdministrator
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AttachingAdministrator extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Authorization\Models\Administrator|int */
    public $administrator;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AttachingAdministrator constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role               $role
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|int  $administrator
     */
    public function __construct(Role $role, $administrator)
    {
        parent::__construct($role);

        $this->administrator = $administrator;
    }
}
