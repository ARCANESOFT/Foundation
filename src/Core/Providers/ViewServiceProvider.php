<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Providers;

use Arcanesoft\Foundation\Core\Views\Composers\{MetricsComposer, NotificationsComposer, SidebarComposer};
use Arcanesoft\Foundation\Support\Providers\ViewServiceProvider as ServiceProvider;

/**
 * Class     ViewServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ViewServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Get the view composers.
     *
     * @return string[]|array
     */
    public function composers(): array
    {
        return [
            SidebarComposer::class,
            MetricsComposer::class,
            NotificationsComposer::class,
        ];
    }
}
