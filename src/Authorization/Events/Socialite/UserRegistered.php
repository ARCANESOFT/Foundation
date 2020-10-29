<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Socialite;

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

    /** @var  \Arcanesoft\Foundation\Authorization\Models\User */
    public $user;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * UserRegistered constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User  $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
