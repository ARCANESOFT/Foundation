<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Administrators\Roles;

use Arcanesoft\Foundation\Auth\Events\Administrators\AdministratorEvent;
use Arcanesoft\Foundation\Auth\Models\Administrator;
use Illuminate\Support\Collection;

/**
 * Class     SyncingRoles
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SyncingRoles extends AdministratorEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Illuminate\Support\Collection|\Arcanesoft\Foundation\Auth\Models\Role[] */
    public $roles;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * SyncingRolesToAdmin constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     * @param  \Illuminate\Support\Collection                    $roles
     */
    public function __construct(Administrator $administrator, Collection $roles)
    {
        parent::__construct($administrator);

        $this->roles = $roles;
    }
}
