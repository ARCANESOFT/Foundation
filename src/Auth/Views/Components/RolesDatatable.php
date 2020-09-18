<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Views\Components;

use Arcanesoft\Foundation\Auth\Policies\RolesPolicy;
use Arcanesoft\Foundation\Auth\Repositories\RolesRepository;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class     RolesDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesDatatable extends DatatableComponent
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const NAME = 'foundation::authorization.roles.index';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    public $sortField = 'name';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check the authorization.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $guard
     *
     * @return bool
     */
    public function authorize(Gate $guard): bool
    {
        return $guard->allows(RolesPolicy::ability('index'));
    }

    /**
     * Render the component.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $repo
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(RolesRepository $repo)
    {
        return view('foundation::authorization.roles._datatables.index', [
            'roles'  => $this->getResults($repo),
            'fields' => $this->prepareFields(),
        ]);
    }

    /**
     * Get the results.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $repo
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function getResults(RolesRepository $repo): LengthAwarePaginator
    {
        return $repo
            ->withCount(['administrators'])
            ->unless(empty($this->search), function (Builder $query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->unless(empty($this->sortField), function (Builder $query) {
                $query->orderBy($this->sortField, $this->getSortDirection());
            })
            ->paginate($this->perPage);
    }

    /**
     * Get the fields.
     *
     * @return array
     */
    private function prepareFields(): array
    {
        return [
            'name'           => $this->renderSortField('name', 'Name'),
            'description'    => $this->renderSortField('description', 'Description'),
            'created_at'     => $this->renderSortField('created_at', 'Created at'),
            'administrators' => __('Administrators'),
            'locked'         => __('Locked'),
            'status'         => __('Status'),
            'actions'        => __('Actions'),
        ];
    }
}
