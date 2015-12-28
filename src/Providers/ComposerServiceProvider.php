<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Support\ServiceProvider;

/**
 * Class     ComposerServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ComposerServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        view()->composer(
            'foundation::_template.sidebar-main',
            \Arcanesoft\Foundation\ViewComposers\SidebarComposer::class
        );
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        //
    }
}
