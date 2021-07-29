<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Http\Datatables;

use Arcanesoft\Foundation\Cms\Http\Transformers\LanguageTransformer;
use Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy;
use Arcanesoft\Foundation\Cms\Repositories\LanguagesRepository;
use Arcanesoft\Foundation\Datatable\{Action, Column, Datatable, Filter};
use Arcanesoft\Foundation\Datatable\Concerns\{HasActions, HasFilters, HasPagination};
use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class     LocalesDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LanguagesDatatable extends Datatable
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasActions;
    use HasFilters;
    use HasPagination;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the datatable request.
     *
     * @param  \Arcanesoft\Foundation\Cms\Repositories\LanguagesRepository  $repo
     * @param  \Illuminate\Http\Request                                     $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function handle(LanguagesRepository $repo, Request $request)
    {
        $query = $repo->query();

        $this->handleSearchQuery($request, $query);

        return $query;
    }

    /**
     * @param  \Illuminate\Http\Request               $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function handleSearchQuery(Request $request, Builder $query): Builder
    {
        $search = $this->searchQuery($request);

        return $query->unless(empty($search), function (Builder $q) use ($search) {
            $q->where('code', 'like', '%'.$search.'%');
        });
    }

    /**
     * Define the datatable's columns.
     *
     * @return \Arcanesoft\Foundation\Datatable\Column[]|array
     */
    protected function columns(): array
    {
        return [
            // TODO: Add flag image
            Column::make('code', 'Code')->sortable(),
            Column::make('name', 'Name')->sortable(),
            // TODO: Add active status
            Column::make('created_at', 'Created at')->sortable()->align('center'),
        ];
    }

    /**
     * Define the datatable filters.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Arcanesoft\Foundation\Datatable\Contracts\Filter[]
     */
    protected function filters(Request $request): array
    {
        return [
            //
        ];
    }

    /**
     * Define the datatable actions.
     *
     * @param  \Illuminate\Http\Request                          $request
     * @param  \Arcanesoft\Foundation\Cms\Models\Language|mixed  $language
     *
     * @return array
     */
    protected function actions(Request $request, $language): array
    {
        $actions = [];

        $actions[] = Action::link('show', 'Show', function () use ($language) {
            return route('admin::cms.languages.show', [$language]);
        })->can(function () use ($language) {
            return LanguagesPolicy::can('show', [$language]);
        })->asIcon();

        $actions[] = Action::button('delete', 'Delete', function () use ($language) {
            return "ARCANESOFT.emit('cms::languages.delete', {id: '{$language->getRouteKey()}'})";
        })->can(function () use ($language) {
            return LanguagesPolicy::can('delete', [$language]);
        })->asIcon();

        return $actions;
    }

    /**
     * Get the transformer.
     *
     * @return \Arcanesoft\Foundation\Datatable\Contracts\Transformer
     */
    protected function transformer(): Transformer
    {
        return new LanguageTransformer;
    }
}
