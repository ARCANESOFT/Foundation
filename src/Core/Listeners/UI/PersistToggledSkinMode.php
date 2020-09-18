<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Listeners\UI;

use Arcanesoft\Foundation\Core\Events\UI\SkinModeToggled;

/**
 * Class     PersistToggledSkinMode
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PersistToggledSkinMode
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the event.
     *
     * @param  \Arcanesoft\Foundation\Core\Events\UI\SkinModeToggled  $event
     */
    public function handle(SkinModeToggled $event): void
    {
        session([
            'foundation.skin.mode' => $event->options['mode'] ?? 'light',
        ]);
    }
}
