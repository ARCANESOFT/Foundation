<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Repositories\Authentication;

use Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\DisabledAuthentication as DisabledAuthenticationForAdministrator;
use Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\DisablingAuthentication as DisablingAuthenticationForAdministrator;
use Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\EnabledAuthentication as EnabledAuthenticationForAdministrator;
use Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\EnablingAuthentication as EnablingAuthenticationForAdministrator;
use Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\GeneratedRecoveryCode as GeneratedRecoveryCodeForAdministrator;
use Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\GeneratingRecoveryCode as GeneratingRecoveryCodeForAdministrator;
use Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\ReplacedRecoveryCode as ReplacedRecoveryCodeForAdministrator;
use Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\ReplacingRecoveryCode as ReplacingRecoveryCodeForAdministrator;
use Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\DisabledAuthentication as DisabledAuthenticationForUser;
use Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\DisablingAuthentication as DisablingAuthenticationForUser;
use Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\EnabledAuthentication as EnabledAuthenticationForUser;
use Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\EnablingAuthentication as EnablingAuthenticationForUser;
use Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\GeneratedRecoveryCode as GeneratedRecoveryCodeForUser;
use Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\GeneratingRecoveryCode as GeneratingRecoveryCodeForUser;
use Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\ReplacedRecoveryCode as ReplacedRecoveryCodeForUser;
use Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\ReplacingRecoveryCode as ReplacingRecoveryCodeForUser;
use Arcanesoft\Foundation\Fortify\Services\TwoFactorAuthentication\{RecoveryCode, TwoFactorAuthenticationProvider};
use Illuminate\Support\Arr;

/**
 * Class     TwoFactorAuthenticationRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @todo Complete the events
 */
class TwoFactorAuthenticationRepository
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    private const EVENT_ENABLING                 = 'enabling';
    private const EVENT_ENABLED                  = 'enabled';
    private const EVENT_DISABLING                = 'disabling';
    private const EVENT_DISABLED                 = 'disabled';
    private const EVENT_RECOVERY_CODE_GENERATING = 'recovery_code_generating';
    private const EVENT_RECOVERY_CODE_GENERATED  = 'recovery_code_generated';
    private const EVENT_RECOVERY_CODE_REPLACING  = 'recovery_code_replacing';
    private const EVENT_RECOVERY_CODE_REPLACED   = 'recovery_code_replaced';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Two factor authentication's events.
     *
     * @var  string[][]
     */
    protected $events = [
        'administrator' => [
            self::EVENT_ENABLING                 => EnablingAuthenticationForAdministrator::class,
            self::EVENT_ENABLED                  => EnabledAuthenticationForAdministrator::class,
            self::EVENT_DISABLING                => DisablingAuthenticationForAdministrator::class,
            self::EVENT_DISABLED                 => DisabledAuthenticationForAdministrator::class,
            self::EVENT_RECOVERY_CODE_GENERATING => GeneratingRecoveryCodeForAdministrator::class,
            self::EVENT_RECOVERY_CODE_GENERATED  => GeneratedRecoveryCodeForAdministrator::class,
            self::EVENT_RECOVERY_CODE_REPLACING  => ReplacingRecoveryCodeForAdministrator::class,
            self::EVENT_RECOVERY_CODE_REPLACED   => ReplacedRecoveryCodeForAdministrator::class,
        ],
        'user' => [
            self::EVENT_ENABLING                 => EnablingAuthenticationForUser::class,
            self::EVENT_ENABLED                  => EnabledAuthenticationForUser::class,
            self::EVENT_DISABLING                => DisablingAuthenticationForUser::class,
            self::EVENT_DISABLED                 => DisabledAuthenticationForUser::class,
            self::EVENT_RECOVERY_CODE_GENERATING => GeneratingRecoveryCodeForUser::class,
            self::EVENT_RECOVERY_CODE_GENERATED  => GeneratedRecoveryCodeForUser::class,
            self::EVENT_RECOVERY_CODE_REPLACING  => ReplacingRecoveryCodeForUser::class,
            self::EVENT_RECOVERY_CODE_REPLACED   => ReplacedRecoveryCodeForUser::class,
        ],
    ];

    /** @var  \Arcanesoft\Foundation\Fortify\Services\TwoFactorAuthentication\TwoFactorAuthenticationProvider */
    protected $provider;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * TwoFactorAuthenticationRepository constructor.
     *
     * @param  \Arcanesoft\Foundation\Fortify\Services\TwoFactorAuthentication\TwoFactorAuthenticationProvider  $provider
     */
    public function __construct(TwoFactorAuthenticationProvider $provider)
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
     * @param  \Arcanesoft\Foundation\Authorization\Models\User|\Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $user
     *
     * @return bool
     */
    public function enable($user): bool
    {
        $twoFactor = $user->two_factor()->make()->fill([
            'secret'         => $this->provider->generateSecretKey(),
            'recovery_codes' => static::freshRecoveryCode(),
        ]);

//        $this->dispatchTwoFactorEvent(static::EVENT_ENABLING, $user);
        $saved = $twoFactor->save();
//        $this->dispatchTwoFactorEvent(static::EVENT_ENABLED, $user);

        return $saved;
    }

    /**
     * Disable the two factor authentication.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User|\Arcanesoft\Foundation\Authorization\Models\Administrator  $user
     *
     * @return bool
     */
    public function disable($user): bool
    {
        $twoFactor = $user->two_factor;

//        $this->dispatchTwoFactorEvent(static::EVENT_DISABLING, $user);
        $saved = $twoFactor->delete();
//        $this->dispatchTwoFactorEvent(static::EVENT_DISABLED, $user);

        return $saved;
    }

    /**
     * Generate a new recovery codes.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User|\Arcanesoft\Foundation\Authorization\Models\Administrator  $user
     *
     * @return bool
     */
    public function generateNewRecoveryCodes($user): bool
    {
        $twoFactor = $user->two_factor->fill([
            'recovery_codes' => static::freshRecoveryCode(),
        ]);

//        $this->dispatchTwoFactorEvent(static::EVENT_RECOVERY_CODE_GENERATING, $user);
        $saved = $twoFactor->save();
//        $this->dispatchTwoFactorEvent(static::EVENT_RECOVERY_CODE_GENERATED, $user);

        return $saved;
    }

    /**
     * Replace recovery code.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User|\Arcanesoft\Foundation\Authorization\Models\Administrator  $user
     * @param  string                                                                                    $code
     *
     * @return bool
     */
    public function replaceRecoveryCode($user, string $code): bool
    {
        $recoveryCodes = str_replace(
            $code,
            RecoveryCode::generate(),
            decrypt($user->two_factor->recovery_codes)
        );

        $user->two_factor->fill([
            'recovery_codes' => json_decode($recoveryCodes),
        ]);

//        $this->dispatchTwoFactorEvent(static::EVENT_RECOVERY_CODE_REPLACING, $user);
        $saved = $user->save();
//        $this->dispatchTwoFactorEvent(static::EVENT_RECOVERY_CODE_REPLACED, $user);

        return $saved;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Dispatch the event.
     *
     * @param  string                                                                                    $type
     * @param  \Arcanesoft\Foundation\Authorization\Models\User|\Arcanesoft\Foundation\Authorization\Models\Administrator  $user
     *
     * @return array|null
     */
    protected function dispatchTwoFactorEvent(string $type, $user)
    {
        $key = mb_strtolower(class_basename($user));

        $event = Arr::get($this->events, "{$key}.{$type}");

        return event(new $event($user));
    }

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
