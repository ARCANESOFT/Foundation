<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Datatables;

use Arcanesoft\Foundation\Authorization\Http\Transformers\RoleTransformer;
use Arcanesoft\Foundation\Authorization\Policies\RolesPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\RolesRepository;
use Arcanesoft\Foundation\Datatable\{Action, Column, Datatable, Filter};
use Arcanesoft\Foundation\Datatable\Concerns\{HasActions, HasFilters, HasPagination};
use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class     RolesDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesDatatable extends Datatable
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
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\RolesRepository  $repo
     * @param  \Illuminate\Http\Request                                           $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function handle(RolesRepository $repo, Request $request)
    {
        $query = $repo->query()->withCount(['administrators', 'permissions']);

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
            return $q->where('name', 'like', '%'.$search.'%');
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
            Column::make('administrators', 'Administrators', Column::DATATYPE_BADGE_COUNT)->align('center'),
            Column::make('permissions', 'Permissions', Column::DATATYPE_BADGE_COUNT)->align('center'),
            Column::make('locked', 'Locked', Column::DATATYPE_STATUS)->sortable()->align('center')->escaped(false),
            Column::make('status', 'Status', Column::DATATYPE_BADGE_ACTIVE)->sortable()->align('center')->escaped(false),
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
            Filter::select('status', 'Status', 'all', [
                'all'         => 'All',
                'activated'   => 'Activated',
                'deactivated' => 'Deactivated',
            ])->query(function(Builder $query, $value): Builder {
                return $value === 'activated'
                    ? $query->whereNotNull('activated_at')
                    : $query->whereNull('activated_at');
            }),

            Filter::select('display', 'Display', 'all', [
                'all'      => 'All',
                'locked'   => 'Locked',
                'unlocked' => 'Unlocked',
            ])->query(function(Builder $query, $value): Builder {
                return $query->where('is_locked', $value === 'locked');
            }),
        ];
    }

    /**
     * Define the datatable actions.
     *
     * @param  \Illuminate\Http\Request                                $request
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role|mixed  $role
     *
     * @return array
     */
    protected function actions(Request $request, $role): array
    {
        $actions = [];

        $actions[] = Action::link('show', 'Show', function () use ($role) {
            return route('admin::authorization.roles.show', [$role]);
        })->can(function () use ($role) {
            return RolesPolicy::can('show', [$role]);
        })->asIcon();

        $actions[] = Action::link('edit', 'Edit', function () use ($role) {
            return route('admin::authorization.roles.edit', [$role]);
        })->can(function () use ($role) {
            return RolesPolicy::can('update', [$role]);
        })->asIcon();

        if ($role->isActive()) {
            $actions[] = Action::button('deactivate', 'Deactivate', function () use ($role) {
                return "ARCANESOFT.emit('authorization::roles.deactivate', {id: '{$role->getRouteKey()}'})";
            })->can(function () use ($role) {
                return RolesPolicy::can('deactivate', [$role]);
            })->asIcon();
        }
        else {
            $actions[] = Action::button('activate', 'Activate', function () use ($role) {
                return "ARCANESOFT.emit('authorization::roles.activate', {id: '{$role->getRouteKey()}'})";
            })->can(function () use ($role) {
                return RolesPolicy::can('activate', [$role]);
            })->asIcon();
        }

        $actions[] = Action::button('delete', 'Delete', function () use ($role) {
            return "ARCANESOFT.emit('authorization::roles.delete', {id: '{$role->getRouteKey()}'})";
        })->can(function () use ($role) {
            return RolesPolicy::can('delete', [$role]);
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
        return new RoleTransformer;
    }
}
