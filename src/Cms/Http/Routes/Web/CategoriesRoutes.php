<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Http\Routes\Web;

use Arcanesoft\Foundation\Cms\Http\Controllers\CategoriesController;
use Arcanesoft\Foundation\Cms\Repositories\CategoriesRepository;

/**
 * Class     CategoriesRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CategoriesRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const CATEGORY_WILDCARD = 'admin_cms_category';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->name('categories.')->prefix('categories')->group(function () {
            // admin::cms.categories.index
            $this->get('/', [CategoriesController::class, 'index'])
                 ->name('index');

            // admin::cms.categories.datatable
            $this->post('datatable', [CategoriesController::class, 'datatable'])
                 ->middleware(['ajax'])
                 ->name('datatable');

            // admin::cms.categories.metrics
            $this->get('metrics', [CategoriesController::class, 'metrics'])
                 ->name('metrics');

            // admin::cms.categories.create
            $this->get('create', [CategoriesController::class, 'create'])
                 ->name('create');

            // admin::cms.categories.post
            $this->post('store', [CategoriesController::class, 'store'])
                 ->name('store');

            $this->prefix('{'.static::CATEGORY_WILDCARD.'}')->group(function () {
                // admin::cms.categories.show
                $this->get('/', [CategoriesController::class, 'show'])
                     ->name('show');

                // admin::cms.categories.edit
                $this->get('edit', [CategoriesController::class, 'edit'])
                     ->name('edit');

                // admin::cms.categories.update
                $this->put('update', [CategoriesController::class, 'update'])
                     ->name('update');

                // admin::cms.categories.activate
                $this->put('activate', [CategoriesController::class, 'activate'])
                     ->middleware(['ajax'])
                     ->name('activate');

                // admin::cms.categories.deactivate
                $this->put('deactivate', [CategoriesController::class, 'deactivate'])
                     ->middleware(['ajax'])
                     ->name('deactivate');

                // admin::cms.categories.delete
                $this->delete('delete', [CategoriesController::class, 'delete'])
                     ->middleware(['ajax'])
                     ->name('delete');

                // admin::cms.categories.restore
                $this->put('restore', [CategoriesController::class, 'restore'])
                     ->middleware(['ajax'])
                     ->name('restore');
            });
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Foundation\Cms\Repositories\CategoriesRepository  $repo
     */
    public function bindings(CategoriesRepository $repo): void
    {
        $this->bind(static::CATEGORY_WILDCARD, function (string $uuid) use ($repo) {
            return $repo->firstWhereUuidOrFail($uuid);
        });
    }
}
