<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Listeners\Roles;

use Arcanesoft\Foundation\Authorization\Events\Roles\CreatingRole;
use Illuminate\Support\Str;

/**
 * Class     GeneratesUuid
 *
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
     * @param  \Arcanesoft\Foundation\Authorization\Events\Roles\CreatingRole  $event
     */
    public function handle(CreatingRole $event)
    {
        $event->role->forceFill(['uuid' => Str::uuid()]);
    }
}
