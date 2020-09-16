<?php

namespace Arcanesoft\Foundation\Core\Listeners\UI;

use Arcanesoft\Foundation\Core\Events\UI\SkinModeToggled;

/**
 * Class     PersistToggledSkinMode
 *
 * @package  Arcanesoft\Foundation\Core\Listeners\UI
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
