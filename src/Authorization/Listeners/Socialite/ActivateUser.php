<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Listeners\Socialite;

use Arcanesoft\Foundation\Authorization\Events\Socialite\UserRegistered;
use Arcanesoft\Foundation\Authorization\Repositories\UsersRepository;

/**
 * Class     ActivateUser
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ActivateUser
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Authorization\Repositories\UsersRepository */
    protected $repo;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct(UsersRepository $repo)
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
     * @param  \Arcanesoft\Foundation\Authorization\Events\Socialite\UserRegistered  $event
     */
    public function handle(UserRegistered $event)
    {
        $this->repo->activateOne($event->user);
    }
}
