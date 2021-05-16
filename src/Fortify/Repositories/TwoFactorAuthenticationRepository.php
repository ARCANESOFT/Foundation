<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Repositories;

use Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthentication\HasTwoFactor;
use Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthentication\Provider;
use Arcanesoft\Foundation\Fortify\Events\TwoFactorAuthentication\EnabledTwoFactor;
use Arcanesoft\Foundation\Fortify\Events\TwoFactorAuthentication\EnablingTwoFactor;
use Arcanesoft\Foundation\Fortify\Events\TwoFactorAuthentication\GeneratedRecoveryCode;
use Arcanesoft\Foundation\Fortify\Events\TwoFactorAuthentication\GeneratingRecoveryCode;
use Arcanesoft\Foundation\Fortify\Events\TwoFactorAuthentication\ReplacedRecoveryCode;
use Arcanesoft\Foundation\Fortify\Events\TwoFactorAuthentication\ReplacingRecoveryCode;
use Arcanesoft\Foundation\Fortify\Services\TwoFactorAuthentication\RecoveryCode;

/**
 * Class     TwoFactorAuthenticationRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TwoFactorAuthenticationRepository
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthentication\Provider */
    protected $provider;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * TwoFactorAuthenticationRepository constructor.
     *
     * @param  \Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthentication\Provider  $provider
     */
    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Enable the two factor authentication.
     *
     * @param  \Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthentication\HasTwoFactor|mixed  $user
     *
     * @return bool
     */
    public function enable(HasTwoFactor $user): bool
    {
        $twoFactor = $user->twoFactor()->make()->fill([
            'secret'         => $this->provider->generateSecretKey(),
            'recovery_codes' => static::freshRecoveryCode(),
        ]);

        event(new EnablingTwoFactor($user));
        $saved = $twoFactor->save();
        event(new EnabledTwoFactor($user));

        if ($saved)
            $user->refresh();

        return $saved;
    }

    /**
     * Disable the two factor authentication.
     *
     * @param  \Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthentication\HasTwoFactor|mixed  $user
     *
     * @return bool
     */
    public function disable(HasTwoFactor $user): bool
    {
        $twoFactor = $user->twoFactor;

        event(new EnablingTwoFactor($user));
        $deleted = $twoFactor->delete();
        event(new EnablingTwoFactor($user));

        if ($deleted)
            $user->refresh();

        return $deleted;
    }

    /**
     * Generate a new recovery codes.
     *
     * @param  \Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthentication\HasTwoFactor|mixed  $user
     *
     * @return bool
     */
    public function generateNewRecoveryCodes(HasTwoFactor $user): bool
    {
        $twoFactor = $user->twoFactor->fill([
            'recovery_codes' => static::freshRecoveryCode(),
        ]);

        event(new GeneratingRecoveryCode($user));
        $saved = $twoFactor->save();
        event(new GeneratedRecoveryCode($user));

        return $saved;
    }

    /**
     * Replace recovery code.
     *
     * @param  \Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthentication\HasTwoFactor|mixed  $user
     * @param  string                                                                               $code
     *
     * @return bool
     */
    public function replaceRecoveryCode(HasTwoFactor $user, string $code): bool
    {
        $recoveryCodes = str_replace(
            $code,
            RecoveryCode::generate(),
            decrypt($user->twoFactor->recovery_codes)
        );

        $user->twoFactor->fill([
            'recovery_codes' => json_decode($recoveryCodes),
        ]);

        event(new ReplacingRecoveryCode($user));
        $saved = $user->twoFactor->push();
        event(new ReplacedRecoveryCode($user));

        return $saved;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get a fresh recovery code.
     *
     * @param  int  $number
     *
     * @return array
     */
    protected static function freshRecoveryCode($number = 8)
    {
        return array_map(function() {
            return RecoveryCode::generate();
        }, range(1, $number));
    }
}
