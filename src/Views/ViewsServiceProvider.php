<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views;

use Arcanesoft\Foundation\Support\Providers\ServiceProvider;
use Arcanesoft\Foundation\Views\Contracts\Manager as ManagerContract;
use Illuminate\View\Compilers\BladeCompiler;

/**
 * Class     ViewsServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ViewsServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Package name.
     *
     * @var string|null
     */
    protected $package = 'components';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        parent::register();

        $this->singleton(ManagerContract::class, Manager::class);
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->registerBladeComponents();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register blade components.
     */
    private function registerBladeComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade, $app) {
            $blade->components(
                $app['config']->get('arcanesoft.foundation.view.components')
            );
        });
    }
}
