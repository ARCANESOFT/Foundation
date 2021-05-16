<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Datatables;

use Arcanesoft\Foundation\Authorization\Http\Transformers\UserTransformer;
use Arcanesoft\Foundation\Authorization\Policies\UsersPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\UsersRepository;
use Arcanesoft\Foundation\Datatable\{Action, Column, Datatable, Filter};
use Arcanesoft\Foundation\Datatable\Concerns\{HasActions, HasFilters, HasPagination};
use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class     UsersDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersDatatable extends Datatable
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
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\UsersRepository  $repo
     * @param  \Illuminate\Http\Request                                           $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function handle(UsersRepository $repo, Request $request)
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
            $q->where('first_name', 'like', '%'.$search.'%')
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
            Column::make('avatar', 'Avatar', Column::DATATYPE_AVATAR),
            Column::make('first_name', 'First Name')->sortable(),
            Column::make('last_name', 'Last Name')->sortable(),
            Column::make('email', 'Email')->sortable(Column::SORT_ASC),
            Column::make('created_at', 'Created at')->sortable()->align('center'),
            Column::make('status', 'Status', Column::DATATYPE_BADGE_ACTIVE)->sortable(null, function (Builder $query, Column $column): Builder {
                return $query->orderBy('activated_at', $column->getSortDirection());
            })->align('center')->escaped(false),
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
     * @param  \Arcanesoft\Foundation\Authorization\Models\User|mixed  $user
     *
     * @return array
     */
    protected function actions(Request $request, $user): array
    {
        $actions = [];

        $actions[] = Action::link('show', 'Show', function () use ($user) {
            return route('admin::authorization.users.show', [$user]);
        })->can(function () use ($user) {
            return UsersPolicy::can('show', [$user]);
        })->asIcon();

        $actions[] = Action::link('edit', 'Edit', function () use ($user) {
            return route('admin::authorization.users.edit', [$user]);
        })->can(function () use ($user) {
            return UsersPolicy::can('update', [$user]);
        })->asIcon();

        if ($user->isActive()) {
            $actions[] = Action::button('deactivate', 'Deactivate', function () use ($user) {
                return "ARCANESOFT.emit('authorization::users.deactivate', {id: '{$user->getRouteKey()}'})";
            })->can(function () use ($user) {
                return UsersPolicy::can('deactivate', [$user]);
            })->asIcon();
        }
        else {
            $actions[] = Action::button('activate', 'Activate', function () use ($user) {
                return "ARCANESOFT.emit('authorization::users.activate', {id: '{$user->getRouteKey()}'})";
            })->can(function () use ($user) {
                return UsersPolicy::can('activate', [$user]);
            })->asIcon();
        }

        if ($user->trashed()) {
            $actions[] = Action::button('restore', 'Restore', function () use ($user) {
                return "ARCANESOFT.emit('authorization::users.restore', {id: '{$user->getRouteKey()}'})";
            })->can(function () use ($user) {
                return UsersPolicy::can('restore', [$user]);
            })->asIcon();
        }

        $actions[] = Action::button('delete', 'Delete', function () use ($user) {
            return "ARCANESOFT.emit('authorization::users.delete', {id: '{$user->getRouteKey()}'})";
        })->can(function () use ($user) {
            return UsersPolicy::can('delete', [$user]);
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
        return new UserTransformer;
    }
}
