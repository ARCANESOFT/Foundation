<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Listeners\Users;

use Arcanesoft\Foundation\Authorization\Events\Users\Attributes\UpdatedEmail;

/**
 * Class     NotifyEmailUpdated
 *
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
     * @param  \Arcanesoft\Foundation\Authorization\Events\Users\Attributes\UpdatedEmail  $event
     */
    public function handle(UpdatedEmail $event)
    {
        // TODO: Send email updated notification.
    }
}
