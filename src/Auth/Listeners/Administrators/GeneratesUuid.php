<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Listeners\Administrators;

use Arcanesoft\Foundation\Auth\Events\Administrators\CreatingAdministrator;
use Illuminate\Support\Str;

/**
 * Class     GeneratesUuid
 *
 * @package  Arcanesoft\Foundation\Auth\Listeners\Administrators
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeneratesUuid
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the event.
     *
     * @param  \Arcanesoft\Foundation\Auth\Events\Administrators\CreatingAdministrator  $event
     */
    public function handle(CreatingAdministrator $event)
    {
        $event->administrator->forceFill(['uuid' => Str::uuid()]);
    }
}
