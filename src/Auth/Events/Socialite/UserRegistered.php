<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Socialite;

/**
 * Class     UserRegistered
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UserRegistered
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\User */
    public $user;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * UserRegistered constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
