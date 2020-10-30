<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Events\TwoFactorAuthentication;

use Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthentication\HasTwoFactor;

/**
 * Class     TwoFactorEvent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class TwoFactorEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthentication\HasTwoFactor */
    public $user;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * TwoFactorEvent constructor.
     *
     * @param  \Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthentication\HasTwoFactor  $user
     */
    public function __construct(HasTwoFactor $user)
    {
        $this->user = $user;
    }
}
