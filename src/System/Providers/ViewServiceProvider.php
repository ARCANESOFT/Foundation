<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Providers;

use Arcanesoft\Foundation\System\Views\{Composers, Components};
use Arcanesoft\Foundation\Support\Providers\ViewServiceProvider as ServiceProvider;

/**
 * Class     ViewServiceProvider
 *
 * @package  Arcanesoft\Foundation\System\Providers
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

    /**
     * Get the view composers.
     *
     * @return array
     */
    public function components(): array
    {
        return [
            Components\AbilitiesDatatable::NAME    => Components\AbilitiesDatatable::class,
            Components\RoutesDatatable::NAME       => Components\RoutesDatatable::class,
            Components\DependenciesDatatable::NAME => Components\DependenciesDatatable::class,
        ];
    }
}
