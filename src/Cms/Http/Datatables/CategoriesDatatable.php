<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Http\Datatables;

use Arcanesoft\Foundation\Cms\Http\Transformers\CategoryTransformer;
use Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy;
use Arcanesoft\Foundation\Cms\Repositories\CategoriesRepository;
use Arcanesoft\Foundation\Datatable\{Action, Column, Datatable, Filter};
use Arcanesoft\Foundation\Datatable\Concerns\{HasActions, HasFilters, HasPagination};
use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class     CategoriesDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CategoriesDatatable extends Datatable
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
     * @param  \Arcanesoft\Foundation\Cms\Repositories\CategoriesRepository  $repo
     * @param  \Illuminate\Http\Request                                      $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function handle(CategoriesRepository $repo, Request $request)
    {
        /** @var \Kalnoy\Nestedset\QueryBuilder $query */
        $query = $repo->query()->withCount(['children']);
        $query->whereIsRoot();

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
            $q->where('name', 'like', '%'.$search.'%')
              ->orWhere('slug', 'like', '%'.$search.'%')
            ;
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
            Column::make('name', 'Name')->sortable(),
            Column::make('description', 'Description')->sortable(),
            Column::make('children', 'Sub-categories', Column::DATATYPE_BADGE_COUNT)->align('center'),
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
            Filter::select('display', 'Display', 'list', [
                'list'         => 'List',
                'only-trashed' => 'Only trashed',
            ])->query(function (Builder $query, $value): Builder {
                return $query->onlyTrashed($value === 'only-trashed');
            }),
        ];
    }

    /**
     * Define the datatable actions.
     *
     * @param  \Illuminate\Http\Request                                $request
     * @param  \Arcanesoft\Foundation\Cms\Models\Category|mixed  $category
     *
     * @return array
     */
    protected function actions(Request $request, $category): array
    {
        $actions = [];

        $actions[] = Action::link('show', 'Show', function () use ($category) {
            return route('admin::cms.categories.show', [$category]);
        })->can(function () use ($category) {
            return CategoriesPolicy::can('show', [$category]);
        })->asIcon();

        $actions[] = Action::link('edit', 'Edit', function () use ($category) {
            return route('admin::cms.categories.edit', [$category]);
        })->can(function () use ($category) {
            return CategoriesPolicy::can('update', [$category]);
        })->asIcon();

        if ($category->trashed()) {
            $actions[] = Action::button('restore', 'Restore', function () use ($category) {
                return "ARCANESOFT.emit('cms::categories.restore', {id: '{$category->getRouteKey()}'})";
            })->can(function () use ($category) {
                return CategoriesPolicy::can('restore', [$category]);
            })->asIcon();
        }

        $actions[] = Action::button('delete', 'Delete', function () use ($category) {
            return "ARCANESOFT.emit('cms::categories.delete', {id: '{$category->getRouteKey()}'})";
        })->can(function () use ($category) {
            return CategoriesPolicy::can('delete', [$category]);
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
        return new CategoryTransformer;
    }
}
