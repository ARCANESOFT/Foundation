<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Http\Routes;

use Arcanedev\Support\Routing\RouteRegistrar;
use Arcanesoft\Foundation\Authentication\Http\Controllers\EmailVerificationController;

/**
 * Class     EmailVerificationRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EmailVerificationRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    public const NOTICE = 'admin::auth.email.verification.notice';
    public const RESEND = 'admin::auth.email.verification.resend';
    public const VERIFY = 'admin::auth.email.verification.verify';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->prefix('email/verification')->name('email.verification.')->middleware(['auth'])->group(function () {
            // auth::email.verification.notice
            $this->get('/', [EmailVerificationController::class, 'show'])
                 ->name('notice');

            // auth::email.verification.resend
            $this->post('/', [EmailVerificationController::class, 'resend'])
                 ->middleware(['throttle:6,1']) // TODO: Make the throttle configurable
                 ->name('resend');

            // auth::email.verification.verify
            $this->get('{id}/{hash}', [EmailVerificationController::class, 'verify'])
                 ->middleware(['signed', 'throttle:6,1']) // TODO: Make the throttle configurable
                 ->name('verify');
        });
    }
}
