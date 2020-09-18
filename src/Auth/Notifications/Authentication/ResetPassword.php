<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Notifications\Authentication;

use Arcanesoft\Foundation\Auth\Models\Administrator;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class     ResetPassword
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ResetPassword extends ResetPasswordNotification
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        $authProviderKey = static::getAuthProviderKey($notifiable);

        return (new MailMessage)
            ->subject(__('Reset Password Notification'))
            ->line(__('You are receiving this email because we received a password reset request for your account.'))
            ->action(__('Reset Password'), $this->getPasswordResetUrl($authProviderKey))
            ->line(__('This password reset link will expire in :count minutes.', [
                'count' => config("auth.passwords.{$authProviderKey}.expire")
            ]))
            ->line(__('If you did not request a password reset, no further action is required.'));
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the password reset URL.
     *
     * @param  string  $authProviderKey
     *
     * @return string
     */
    private function getPasswordResetUrl(string $authProviderKey): string
    {
        return url(config('app.url').route(static::getPasswordResetRoute($authProviderKey), ['token' => $this->token], false));
    }

    /**
     * Get the auth provider key.
     *
     * @param  mixed  $notifiable
     *
     * @return string
     */
    private static function getAuthProviderKey($notifiable): string
    {
        if ($notifiable instanceof Administrator)
            return 'admins';

        return 'users';
    }

    /**
     * Get the reset password route by the given notifiable.
     *
     * @param  string  $authProviderKey
     *
     * @return string
     */
    protected static function getPasswordResetRoute($authProviderKey): string
    {
        if ($authProviderKey === 'admins')
            return 'admin::auth.password.reset';

        return 'auth::password.reset';
    }
}
