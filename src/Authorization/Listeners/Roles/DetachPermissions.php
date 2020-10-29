<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Listeners\Roles;

use Arcanesoft\Foundation\Authorization\Events\Roles\DeletingRole;
use Arcanesoft\Foundation\Authorization\Repositories\RolesRepository;

/**
 * Class     DetachPermissions
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachPermissions
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Authorization\Repositories\RolesRepository */
    protected $repo;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachPermissions constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\RolesRepository  $repo
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
     * @param  \Arcanesoft\Foundation\Authorization\Events\Roles\DeletingRole  $event
     */
    public function handle(DeletingRole $event)
    {
        $this->repo->detachAllPermissions($event->role);
    }
}
