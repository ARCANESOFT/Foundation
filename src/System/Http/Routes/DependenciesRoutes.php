<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Routes;

use Arcanesoft\Foundation\System\Http\Controllers\DependenciesController;

/**
 * Class     DependenciesRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DependenciesRoutes extends AbstractRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->prefix('dependencies')->name('dependencies.')->group(function () {
            // admin::system.dependencies.index
            $this->get('/', [DependenciesController::class, 'index'])
                ->name('index');

            // admin::system.dependencies.show
            $this->get('{admin_package_key}', [DependenciesController::class, 'show'])
                ->name('show');
        });
    }
}
