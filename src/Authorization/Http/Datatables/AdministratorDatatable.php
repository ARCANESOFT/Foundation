<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Datatables;

use Arcanesoft\Foundation\Authorization\Http\Transformers\AdministratorTransformer;
use Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\AdministratorsRepository;
use Arcanesoft\Foundation\Datatable\{Action, Column, Datatable, Filter};
use Arcanesoft\Foundation\Datatable\Concerns\{HasActions, HasFilters, HasPagination};
use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class     AdministratorDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdministratorDatatable extends Datatable
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
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\AdministratorsRepository  $repo
     * @param  \Illuminate\Http\Request                                                    $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function handle(AdministratorsRepository $repo, Request $request)
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

        return $query->unless(empty($search), function (Builder $q) use ($search): Builder {
            return $q->where('first_name', 'like', '%'.$search.'%')
              ->orWhere('last_name', 'like', '%'.$search.'%')
              ->orWhere('email', 'like', '%'.$search.'%');
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
            Column::make('first_name', 'First Name')->sortable(),
            Column::make('last_name', 'Last Name')->sortable(),
            Column::make('email', 'Email')->sortable(),
            Column::make('created_at', 'Created at')->sortable()->align('center'),
            Column::make('status', 'Status', Column::DATATYPE_BADGE_ACTIVE)->sortable(null, function (Builder $query, Column $column): Builder {
                return $query->orderBy('activated_at', $column->getSortDirection());
            })->align('center')->escaped(false),
        ];
    }

    /**
     * Define the datatable filters.
     *
     * @return \Arcanesoft\Foundation\Datatable\Contracts\Filter[]
     */
    protected function filters(): array
    {
        return [
            Filter::select('status', 'Status', 'all', [
                'all'         => 'All',
                'activated'   => 'Activated',
                'deactivated' => 'Deactivated',
            ])->query(function(Builder $query, $value): Builder {
                return $value === 'activated'
                    ? $query->whereNotNull('activated_at')
                    : $query->whereNull('activated_at');
            }),

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
     * @param  \Illuminate\Http\Request                                         $request
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return array
     */
    protected function actions(Request $request, $administrator): array
    {
        $actions = [];

        $actions[] = Action::link('show', 'Show', function () use ($administrator) {
            return route('admin::authorization.administrators.show', [$administrator]);
        })->can(function () use ($administrator) {
            return AdministratorsPolicy::can('show', [$administrator]);
        })->asIcon();

        $actions[] = Action::link('edit', 'Edit', function () use ($administrator) {
            return route('admin::authorization.administrators.edit', [$administrator]);
        })->can(function () use ($administrator) {
            return AdministratorsPolicy::can('update', [$administrator]);
        })->asIcon();

        if ($administrator->isActive()) {
            $actions[] = Action::button('deactivate', 'Deactivate', function () use ($administrator) {
                return "ARCANESOFT.emit('authorization::administrators.deactivate', {id: '{$administrator->getRouteKey()}'})";
            })->can(function () use ($administrator) {
                return AdministratorsPolicy::can('deactivate', [$administrator]);
            })->asIcon();
        }
        else {
            $actions[] = Action::button('activate', 'Activate', function () use ($administrator) {
                return "ARCANESOFT.emit('authorization::administrators.activate', {id: '{$administrator->getRouteKey()}'})";
            })->can(function () use ($administrator) {
                return AdministratorsPolicy::can('activate', [$administrator]);
            })->asIcon();
        }

        if ($administrator->trashed()) {
            $actions[] = Action::button('restore', 'Restore', function () use ($administrator) {
                return "ARCANESOFT.emit('authorization::administrators.restore', {id: '{$administrator->getRouteKey()}'})";
            })->can(function () use ($administrator) {
                return AdministratorsPolicy::can('restore', [$administrator]);
            })->asIcon();
        }

        $actions[] = Action::button('delete', 'Delete', function () use ($administrator) {
            return "ARCANESOFT.emit('authorization::administrators.delete', {id: '{$administrator->getRouteKey()}'})";
        })->can(function () use ($administrator) {
            return AdministratorsPolicy::can('delete', [$administrator]);
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
        return new AdministratorTransformer;
    }
}
