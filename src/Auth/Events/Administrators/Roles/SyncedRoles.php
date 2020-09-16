<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Administrators\Roles;

use Arcanesoft\Foundation\Auth\Events\Administrators\AdministratorEvent;
use Arcanesoft\Foundation\Auth\Models\Administrator;
use Illuminate\Support\Collection;

/**
 * Class     SyncedRoles
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Administrators\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SyncedRoles extends AdministratorEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Illuminate\Support\Collection|\Arcanesoft\Foundation\Auth\Models\Role[] */
    public $roles;

    /** @var  array */
    public $synced;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * SyncingRolesToAdmin constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     * @param  \Illuminate\Support\Collection                    $roles
     * @param  array                                             $synced
     */
    public function __construct(Administrator $administrator, Collection $roles, array $synced)
    {
        parent::__construct($administrator);

        $this->roles  = $roles;
        $this->synced = $synced;
    }
}
