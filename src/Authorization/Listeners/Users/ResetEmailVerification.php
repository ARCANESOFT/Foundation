<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Listeners\Users;

use Arcanesoft\Foundation\Authorization\Events\Users\Attributes\UpdatingEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;

/**
 * Class     ResetEmailVerification
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ResetEmailVerification
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the event.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Events\Users\Attributes\UpdatingEmail  $event
     */
    public function handle(UpdatingEmail $event)
    {
        if ($event->user instanceof MustVerifyEmail)
            $event->user->forceFill(['email_verified_at' => null]);
    }
}
