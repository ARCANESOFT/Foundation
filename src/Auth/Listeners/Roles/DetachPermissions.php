<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Listeners\Roles;

use Arcanesoft\Foundation\Auth\Events\Roles\DeletingRole;
use Arcanesoft\Foundation\Auth\Repositories\RolesRepository;

/**
 * Class     DetachingPermissions
 *
 * @package  Arcanesoft\Foundation\Auth\Listeners\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachPermissions
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository */
    protected $repo;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachPermissions constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $repo
     */
    public function __construct(RolesRepository $repo)
    {
        $this->repo = $repo;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the event.
     *
     * @param  \Arcanesoft\Foundation\Auth\Events\Roles\DeletingRole  $event
     */
    public function handle(DeletingRole $event)
    {
        $this->repo->detachAllPermissions($event->role);
    }
}
