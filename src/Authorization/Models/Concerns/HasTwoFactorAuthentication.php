<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Models\Concerns;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Models\TwoFactor;

/**
 * Trait     HasTwoFactorAuthentication
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  string|null  two_factor_secret
 * @property  string|null  two_factor_recovery_codes
 *
 * @property  \Arcanesoft\Foundation\Authorization\Models\TwoFactor  two_factor
 */
trait HasTwoFactorAuthentication
{
    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * Get the two factor model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function two_factor()
    {
        return $this->morphOne(Auth::model('two-factor', TwoFactor::class), 'two_factorable');
    }

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

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if two factor authentication is enabled.
     *
     * @return bool
     */
    public function isTwoFactorEnabled(): bool
    {
        return ! is_null($this->two_factor);
    }
}
