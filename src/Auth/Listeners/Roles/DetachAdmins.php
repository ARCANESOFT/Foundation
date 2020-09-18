<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Listeners\Roles;

use Arcanesoft\Foundation\Auth\Events\Roles\DeletingRole;
use Arcanesoft\Foundation\Auth\Repositories\RolesRepository;

/**
 * Class     DetachAdmins
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachAdmins
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
     * DetachUsers constructor.
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
        $this->repo->detachAllUsers($event->role);
    }
}
