<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Views\Components;

use Arcanesoft\Foundation\Auth\Policies\UsersPolicy;
use Arcanesoft\Foundation\Auth\Repositories\UsersRepository;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class     UsersDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersDatatable extends DatatableComponent
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const NAME = 'foundation::authorization.users.index';

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
        return $guard->allows(UsersPolicy::ability('index'));
    }

    /**
     * Render the component.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\UsersRepository  $repo
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(UsersRepository $repo)
    {
        return view('foundation::authorization.users._datatables.index', [
            'users'  => $this->getResults($repo),
            'fields' => $this->prepareFields(),
        ]);
    }

    /**
     * Get the results.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\UsersRepository  $repo
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function getResults(UsersRepository $repo): LengthAwarePaginator
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
            'avatar'     => '',
            'first_name' => $this->renderSortField('first_name', 'First name'),
            'last_name'  => $this->renderSortField('last_name', 'Last name'),
            'email'      => $this->renderSortField('email', 'Email'),
            'created_at' => $this->renderSortField('created_at', 'Created at'),
            'status'     => __('Status'),
            'actions'    => __('Actions'),
        ];
    }
}
