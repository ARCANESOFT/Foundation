<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views;

use Arcanesoft\Foundation\Support\Providers\ServiceProvider;
use Illuminate\Support\Collection;
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
        //
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
            $prefix     = $app['config']->get('arcanesoft.foundation.view.prefix', '');
            $components = $app['config']->get('arcanesoft.foundation.view.components', []);

            $blade->components(
                Collection::make($components)->mapWithKeys(function ($component, $key) use ($prefix) {
                    return ["{$prefix}{$key}" => $component];
                })->toArray()
            );
        });
    }
}
