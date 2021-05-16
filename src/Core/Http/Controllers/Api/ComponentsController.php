<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Controllers\Api;

use Arcanesoft\Foundation\Views\Contracts\Manager;
use Illuminate\Http\Request;

/**
 * Class     ComponentsController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ComponentsController
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  \Arcanesoft\Foundation\Views\Contracts\Manager  $manager
     * @param  \Illuminate\Http\Request                        $request
     *
     * @return \Arcanesoft\Foundation\Views\Component
     */
    public function handle(Manager $manager, Request $request)
    {
        return $manager->resolve($request);
    }
}
