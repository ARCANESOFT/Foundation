<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthentication;

/**
 * Interface  HasTwoFactor
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  \Arcanesoft\Foundation\Authorization\Models\TwoFactor  twoFactor
 */
interface HasTwoFactor
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the two factor model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function twoFactor();

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if two factor authentication is enabled.
     *
     * @return bool
     */
    public function isTwoFactorEnabled(): bool;
}
