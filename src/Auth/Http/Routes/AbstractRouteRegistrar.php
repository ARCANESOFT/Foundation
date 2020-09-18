<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes;

use Arcanesoft\Foundation\Support\Http\AdminRouteRegistrar;
use Closure;

/**
 * Class     AbstractRouteRegistrar
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AbstractRouteRegistrar extends AdminRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Group routes under a module stack.
     *
     * @param  \Closure  $callback
     */
    protected function moduleGroup(Closure $callback)
    {
        $this->prefix('authorization')
             ->name('auth.')
             ->group($callback);
    }
}
