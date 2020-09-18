<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Services\TwoFactorAuthentication;

use Illuminate\Support\Str;

/**
 * Class     RecoveryCode
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RecoveryCode
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Generate a new recovery code.
     *
     * @return string
     */
    public static function generate(): string
    {
        return Str::random(10).'-'.Str::random(10);
    }
}
