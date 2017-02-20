<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Support\Providers\ViewComposerServiceProvider as ServiceProvider;
use Arcanesoft\Foundation\ViewComposers;

/**
 * Class     ViewComposerServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ViewComposerServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */
    /**
     * Register the composer classes.
     *
     * @var array
     */
    protected $composerClasses = [
        ViewComposers\SidebarComposer::VIEW                   => ViewComposers\SidebarComposer::class,
        ViewComposers\System\ServerRequirementsComposer::VIEW => ViewComposers\System\ServerRequirementsComposer::class,
        ViewComposers\System\FoldersPermissionsComposer::VIEW => ViewComposers\System\FoldersPermissionsComposer::class,
    ];
}