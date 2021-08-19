<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Models\Concerns;

use Arcanesoft\Foundation\Authorization\Notifications\Authentication\ResetPassword as ResetPasswordNotification;

/**
 * Trait     CanResetPassword
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait CanResetPassword
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
