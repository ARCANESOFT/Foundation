<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Http\Routes\Web;

use Arcanesoft\Foundation\Cms\Http\Controllers\LanguagesController;
use Arcanesoft\Foundation\Cms\Repositories\LanguagesRepository;

/**
 * Class     LanguagesRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LanguagesRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const LANGUAGE_WILDCARD = 'admin_cms_language';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->name('languages.')->prefix('languages')->group(function () {
            // admin::cms.languages.index
            $this->get('/', [LanguagesController::class, 'index'])
                 ->name('index');

            // admin::cms.languages.datatable
            $this->post('datatable', [LanguagesController::class, 'datatable'])
                 ->middleware(['ajax'])
                 ->name('datatable');

            // admin::cms.languages.metrics
            $this->get('metrics', [LanguagesController::class, 'metrics'])
                 ->name('metrics');

            // admin::cms.languages.create
            $this->get('create', [LanguagesController::class, 'create'])
                 ->name('create');

            // admin::cms.languages.post
            $this->post('store', [LanguagesController::class, 'store'])
                 ->name('store');

            $this->prefix('{'.static::LANGUAGE_WILDCARD.'}')->group(function () {
                // admin::cms.languages.show
                $this->get('/', [LanguagesController::class, 'show'])
                     ->name('show');

                // admin::cms.languages.activate
                $this->put('activate', [LanguagesController::class, 'activate'])
                     ->middleware(['ajax'])
                     ->name('activate');

                // admin::cms.languages.deactivate
                $this->put('deactivate', [LanguagesController::class, 'deactivate'])
                     ->middleware(['ajax'])
                     ->name('deactivate');

                // admin::cms.languages.delete
                $this->delete('delete', [LanguagesController::class, 'delete'])
                     ->middleware(['ajax'])
                     ->name('delete');
            });
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Foundation\Cms\Repositories\LanguagesRepository  $repo
     */
    public function bindings(LanguagesRepository $repo): void
    {
        $this->bind(static::LANGUAGE_WILDCARD, function (string $id) use ($repo) {
            return $repo->findOrFail($id);
        });
    }
}
