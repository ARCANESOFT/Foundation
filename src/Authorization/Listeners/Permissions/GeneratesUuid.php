<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Listeners\Permissions;

use Arcanesoft\Foundation\Authorization\Events\Permissions\CreatingPermission;
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
     * @param  \Arcanesoft\Foundation\Authorization\Events\Permissions\CreatingPermission  $event
     */
    public function handle(CreatingPermission $event)
    {
        $event->permission->forceFill(['uuid' => Str::uuid()]);
    }
}
