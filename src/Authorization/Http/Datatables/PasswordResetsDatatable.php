<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Datatables;

use Arcanesoft\Foundation\Authorization\Http\Transformers\PasswordResetTransformer;
use Arcanesoft\Foundation\Authorization\Policies\PasswordResetsPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\PasswordResetsRepository;
use Arcanesoft\Foundation\Datatable\{Action, Column, Datatable};
use Arcanesoft\Foundation\Datatable\Concerns\HasActions;
use Arcanesoft\Foundation\Datatable\Concerns\HasPagination;
use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class     PasswordResetsDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordResetsDatatable extends Datatable
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasActions;
    use HasPagination;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the datatable request.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\PasswordResetsRepository  $repo
     * @param  \Illuminate\Http\Request                                                    $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function handle(PasswordResetsRepository $repo, Request $request)
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
            $q->where('email', 'like', '%'.$search.'%');
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
            Column::make('email', 'Email')->sortable(),
            Column::make('created_at', 'Created at')->sortable()->align('center'),
        ];
    }

    /**
     * Define the datatable actions.
     *
     * @param  \Illuminate\Http\Request                                $request
     * @param  \Arcanesoft\Foundation\Authorization\Models\PasswordReset|mixed  $role
     *
     * @return array
     */
    protected function actions(Request $request, $role): array
    {
        $actions = [];

        $actions[] = Action::link('show', 'Show', function () use ($role) {
            return route('admin::authorization.roles.show', [$role]);
        })->can(function () use ($role) {
            return PasswordResetsPolicy::can('show', [$role]);
        })->asIcon();

        $actions[] = Action::link('edit', 'Edit', function () use ($role) {
            return route('admin::authorization.roles.edit', [$role]);
        })->can(function () use ($role) {
            return PasswordResetsPolicy::can('update', [$role]);
        })->asIcon();

        if ($role->isActive()) {
            $actions[] = Action::button('deactivate', 'Deactivate', function () use ($role) {
                return "ARCANESOFT.emit('authorization::roles.deactivate', {id: '{$role->getRouteKey()}'})";
            })->can(function () use ($role) {
                return PasswordResetsPolicy::can('deactivate', [$role]);
            })->asIcon();
        }
        else {
            $actions[] = Action::button('activate', 'Activate', function () use ($role) {
                return "ARCANESOFT.emit('authorization::roles.activate', {id: '{$role->getRouteKey()}'})";
            })->can(function () use ($role) {
                return PasswordResetsPolicy::can('activate', [$role]);
            })->asIcon();
        }

        $actions[] = Action::button('delete', 'Delete', function () use ($role) {
            return "ARCANESOFT.emit('authorization::roles.delete', {id: '{$role->getRouteKey()}'})";
        })->can(function () use ($role) {
            return PasswordResetsPolicy::can('delete', [$role]);
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
        return new PasswordResetTransformer;
    }
}
