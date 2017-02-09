<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Support\Providers\ViewComposerServiceProvider as ServiceProvider;
use Arcanesoft\Foundation\ViewComposers\SidebarComposer;
use Arcanesoft\Foundation\ViewComposers\System\FoldersPermissionsComposer;
use Arcanesoft\Foundation\ViewComposers\System\ServerRequirementsComposer;

/**
 * Class     ViewComposerServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ViewComposerServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the composer classes.
     *
     * @var array
     */
    protected $composerClasses = [
        SidebarComposer::VIEW_NAME            => SidebarComposer::class,
        ServerRequirementsComposer::VIEW_NAME => ServerRequirementsComposer::class,
        FoldersPermissionsComposer::VIEW_NAME => FoldersPermissionsComposer::class,
    ];
}
