<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Datatables;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Http\Transformers\PermissionTransformer;
use Arcanesoft\Foundation\Authorization\Policies\PermissionsPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\PermissionsRepository;
use Arcanesoft\Foundation\Datatable\{Action, Column, Datatable};
use Arcanesoft\Foundation\Datatable\Concerns\{HasActions, HasFilters, HasPagination};
use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class     PermissionsDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsDatatable extends Datatable
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
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\PermissionsRepository  $repo
     * @param  \Illuminate\Http\Request                                                 $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function handle(PermissionsRepository $repo, Request $request)
    {
        $permissionTable = Auth::table('permissions');
        $groupsTable     = Auth::table('permissions-groups');

        $query = $repo
            ->query()
            ->with(['group'])
            ->withCount(['roles'])
            ->join($groupsTable, "{$permissionTable}.group_id", '=', "{$groupsTable}.id");

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
            $permissionTable = Auth::table('permissions');
            $groupsTable     = Auth::table('permissions-groups');

            // TODO: Add search in Group
            return $q
                ->where("{$groupsTable}.name", 'like', '%'.$search.'%')
                ->orWhere("{$permissionTable}.category", 'like', '%'.$search.'%')
                ->orWhere("{$permissionTable}.name", 'like', '%'.$search.'%');
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
            Column::make('group', 'Group')->sortable(Column::SORT_ASC, function (Builder $query, Column $column): Builder {
                $groupsTable = Auth::table('permissions-groups');

                return $query->orderBy("{$groupsTable}.name", $column->getSortDirection());
            }),
            Column::make('category', 'Category')->sortable(),
            Column::make('name', 'Name')->sortable(),
            Column::make('description', 'Description')->sortable(),
            Column::make('roles', 'Roles', Column::DATATYPE_BADGE_COUNT)->align('center'),
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
            //
        ];
    }

    /**
     * Define the datatable actions.
     *
     * @param  \Illuminate\Http\Request                                      $request
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission|mixed  $permission
     *
     * @return array
     */
    protected function actions(Request $request, $permission): array
    {
        return [
            Action::link('show', 'Show', function () use ($permission) {
                return route('admin::authorization.permissions.show', [$permission]);
            })->can(function () use ($permission) {
                return PermissionsPolicy::can('show', [$permission]);
            })->asIcon()
        ];
    }

    /**
     * Get the transformer.
     *
     * @return \Arcanesoft\Foundation\Datatable\Contracts\Transformer
     */
    protected function transformer(): Transformer
    {
        return new PermissionTransformer;
    }
}
