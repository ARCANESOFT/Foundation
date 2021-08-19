<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Listeners\Administrators;

use Arcanesoft\Foundation\Authorization\Events\Administrators\CreatingAdministrator;
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
     * @param  \Arcanesoft\Foundation\Authorization\Events\Administrators\CreatingAdministrator  $event
     */
    public function handle(CreatingAdministrator $event)
    {
        $event->administrator->forceFill(['uuid' => Str::uuid()]);
    }
}
