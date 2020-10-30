<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Repositories\Concerns\Authentication;

use Arcanesoft\Foundation\Fortify\Repositories\TwoFactorAuthenticationRepository;

/**
 * Trait     HasTwoFactorAuthentication
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasTwoFactorAuthentication
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the two factor authentication's repository.
     *
     * @return \Arcanesoft\Foundation\Fortify\Repositories\TwoFactorAuthenticationRepository
     */
    public function twoFactorAuthentication()
    {
        return app(TwoFactorAuthenticationRepository::class);
    }
}
