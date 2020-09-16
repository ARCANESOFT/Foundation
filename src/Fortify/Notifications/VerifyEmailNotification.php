<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{Config, URL};

/**
 * Class     VerifyEmailNotification
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class VerifyEmailNotification extends VerifyEmail
{
    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     *
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        $expiration = Carbon::now()->addMinutes((int) Config::get('auth.verification.expire', 60));

        return URL::temporarySignedRoute($this->getVerificationRoute(), $expiration, [
            'id'   => $notifiable->getKey(),
            'hash' => sha1($notifiable->getEmailForVerification()),
        ]);
    }

    /**
     * Get the verification route.
     *
     * @return string
     */
    abstract protected function getVerificationRoute(): string;
}
