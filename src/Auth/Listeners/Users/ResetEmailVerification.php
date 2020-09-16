<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Listeners\Users;

use Arcanesoft\Foundation\Auth\Events\Users\Attributes\UpdatingEmail;

/**
 * Class     ResetEmailVerification
 *
 * @package  Arcanesoft\Foundation\Auth\Listeners\Users
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
     * @param  \Arcanesoft\Foundation\Auth\Events\Users\Attributes\UpdatingEmail  $event
     */
    public function handle(UpdatingEmail $event)
    {
        $event->user->forceFill(['email_verified_at' => null]);
    }
}
