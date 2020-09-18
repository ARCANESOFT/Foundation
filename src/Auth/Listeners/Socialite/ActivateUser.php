<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Listeners\Socialite;

use Arcanesoft\Foundation\Auth\Events\Socialite\UserRegistered;
use Arcanesoft\Foundation\Auth\Repositories\UsersRepository;

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

    /** @var  \Arcanesoft\Foundation\Auth\Repositories\UsersRepository */
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
     * @param  \Arcanesoft\Foundation\Auth\Events\Socialite\UserRegistered  $event
     */
    public function handle(UserRegistered $event)
    {
        $this->repo->activateOne($event->user);
    }
}
