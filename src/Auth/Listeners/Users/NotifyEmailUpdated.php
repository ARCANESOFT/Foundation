<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Listeners\Users;

use Arcanesoft\Foundation\Auth\Events\Users\Attributes\UpdatedEmail;

/**
 * Class     NotifyEmailUpdated
 *
 * @package  Arcanesoft\Foundation\Auth\Listeners\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class NotifyEmailUpdated
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the event.
     *
     * @param  \Arcanesoft\Foundation\Auth\Events\Users\Attributes\UpdatedEmail  $event
     */
    public function handle(UpdatedEmail $event)
    {
        // TODO: Send email updated notification.
    }
}
