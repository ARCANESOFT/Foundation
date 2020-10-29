<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Views\Components;

use Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\AdministratorsRepository;
use Illuminate\Contracts\Auth\Access\Gate;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class     AdministratorsDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdministratorsDatatable extends DatatableComponent
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const NAME = 'foundation::authorization.administrators.index';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    public $sortField = 'email';

    public $trash = false;

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
        return $guard->allows(AdministratorsPolicy::ability('index'));
    }

    /**
     * Render the component.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\AdministratorsRepository  $repo
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(AdministratorsRepository $repo)
    {
        return view('foundation::authorization.administrators._datatables.index', [
            'administrators' => $this->getResults($repo),
            'fields'         => $this->prepareFields(),
        ]);
    }

    /**
     * Get the results.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\AdministratorsRepository  $repo
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function getResults(AdministratorsRepository $repo)
    {
        return $repo
            ->onlyTrashed($this->trash)
            ->unless(empty($this->search), function (Builder $query) {
                $query
                    ->where('first_name', 'like', '%'.$this->search.'%')
                    ->orWhere('last_name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            })
            ->unless(empty($this->sortField), function (Builder $query) {
                $query->orderBy($this->sortField, $this->getSortDirection());
            })
            ->paginate($this->perPage);
    }

    /**
     * Get the fields
     *
     * @return array
     */
    private function prepareFields(): array
    {
        return [
            'first_name' => $this->renderSortField('first_name', 'First Name'),
            'last_name'  => $this->renderSortField('last_name', 'Last Name'),
            'email'      => $this->renderSortField('email', 'Email'),
            'created_at' => $this->renderSortField('created_at', 'Created at'),
            'status'     => __('Status'),
            'actions'    => __('Actions'),
        ];
    }
}
