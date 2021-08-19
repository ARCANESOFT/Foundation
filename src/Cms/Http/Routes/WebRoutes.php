<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Http\Routes;

use Arcanesoft\Foundation\Support\Http\AdminRouteRegistrar;
use Closure;

/**
 * Class     WebRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class WebRoutes extends AdminRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the route classes.
     *
     * @return array
     */
    protected function getRouteClasses(): array
    {
        return [
            Web\DashboardRoutes::class,
            Web\LanguagesRoutes::class,
            Web\CategoriesRoutes::class,
        ];
    }

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->adminGroup(function (): void {
            static::mapRouteClasses($this->getRouteClasses());
        });
    }

    /**
     * Bind the routes.
     */
    public function bindings(): void
    {
        static::bindRouteClasses($this->getRouteClasses());
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Group routes under a module stack.
     *
     * @param  \Closure  $callback
     */
    protected function moduleGroup(Closure $callback)
    {
        $this->prefix('cms')
             ->name('cms.')
             ->group($callback);
    }
}
