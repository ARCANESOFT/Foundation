<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models\Concerns;

/**
 * Trait     HasTwoFactorAuthentication
 *
 * @package  Arcanesoft\Foundation\Auth\Models\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  string|null  two_factor_secret
 * @property  string|null  two_factor_recovery_codes
 *
 * @property  \Arcanesoft\Foundation\Auth\Models\Entities\TwoFactor  two_factor
 */
trait HasTwoFactorAuthentication
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the user's two factor authentication recovery codes.
     *
     * @return array
     */
    public function recoveryCodes(): array
    {
        return json_decode(decrypt($this->two_factor->getRecoveryCodes()), true);
    }
}
