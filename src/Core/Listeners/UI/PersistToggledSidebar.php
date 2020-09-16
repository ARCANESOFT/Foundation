<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Listeners\UI;

use Arcanesoft\Foundation\Core\Events\UI\SidebarToggled;

/**
 * Class     PersistToggledSidebar
 *
 * @package  Arcanesoft\Foundation\Core\Listeners\UI
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PersistToggledSidebar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the event.
     *
     * @param  \Arcanesoft\Foundation\Core\Events\UI\SidebarToggled  $event
     */
    public function handle(SidebarToggled $event): void
    {
        session([
            'foundation.sidebar.visible' => $event->options['visible'] ?? 'true',
        ]);
    }
}
