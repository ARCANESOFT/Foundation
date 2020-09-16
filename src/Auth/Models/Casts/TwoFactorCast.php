<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models\Casts;

use Arcanesoft\Foundation\Auth\Models\Entities\TwoFactor;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

/**
 * Class     TwoFactorCast
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TwoFactorCast implements CastsAttributes
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|\Arcanesoft\Foundation\Auth\Models\User  $model
     * @param  string                                                                                    $key
     * @param  mixed                                                                                     $value
     * @param  array                                                                                     $attributes
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Entities\TwoFactor
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return new TwoFactor(
            $model->email,
            $attributes['two_factor_secret'],
            $attributes['two_factor_recovery_codes']
        );
    }

    /**
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|\Arcanesoft\Foundation\Auth\Models\User  $model
     * @param  string                                                                                    $key
     * @param  \Arcanesoft\Foundation\Auth\Models\Entities\TwoFactor|mixed                               $value
     * @param  array                                                                                     $attributes
     *
     * @return array
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if ( ! $value instanceof TwoFactor) {
            throw new InvalidArgumentException('The given value is not an TwoFactor instance.');
        }

        return [
            'two_factor_secret'         => $value->getSecret(),
            'two_factor_recovery_codes' => $value->getRecoveryCodes(),
        ];
    }
}
