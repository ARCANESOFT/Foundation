<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Rules\Administrators;

use Arcanesoft\Foundation\Authorization\Auth;
use Illuminate\Validation\Rules\Unique;

/**
 * Class     EmailRule
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EmailRule
{
    /* -----------------------------------------------------------------
     |  Rules
     | -----------------------------------------------------------------
     */

    /**
     * Get the unique email rule.
     *
     * @return \Illuminate\Validation\Rules\Unique
     */
    public static function unique(): Unique
    {
        return new Unique(Auth::table('administrators'), 'email');
    }
}