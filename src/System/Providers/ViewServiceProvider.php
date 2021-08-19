<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Providers;

use Arcanesoft\Foundation\System\Views\Composers;
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
            Composers\ApplicationInfoComposer::class,
            Composers\FoldersPermissionsComposer::class,
            Composers\RequiredPhpExtensionsComposer::class,
        ];
    }
}
