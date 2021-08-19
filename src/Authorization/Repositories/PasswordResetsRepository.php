<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Repositories;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Models\PasswordReset;

/**
 * Class     PasswordResetsRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @mixin  \Arcanesoft\Foundation\Authorization\Models\PasswordReset
 */
class PasswordResetsRepository extends Repository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model FQN class.
     *
     * @return string
     */
    public static function modelClass(): string
    {
        return Auth::model('password-resets', PasswordReset::class);
    }
}
