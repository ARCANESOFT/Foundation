<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Views\Components;

use Arcanesoft\Foundation\Authorization\Policies\PasswordResetsPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\PasswordResetsRepository;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class     PasswordResetsDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordResetsDatatable extends DatatableComponent
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const NAME = 'foundation::authorization.password-resets.index';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    public $sortField = 'email';

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
        return $guard->allows(PasswordResetsPolicy::ability('index'));
    }

    /**
     * Render the component.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\PasswordResetsRepository  $repo
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(PasswordResetsRepository $repo)
    {
        return view('foundation::authorization.password-resets._datatables.index',[
            'passwordResets' => $this->getResults($repo),
            'fields'         => $this->getFields(),
        ]);
    }

    /**
     * Get the results.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\PasswordResetsRepository  $repo
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function getResults(PasswordResetsRepository $repo): LengthAwarePaginator
    {
        return $repo
            ->unless(empty($this->search), function (Builder $query) {
                $query->Where('email', 'like', '%'.$this->search.'%');
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
    private function getFields(): array
    {
        return [
            'email'      => $this->renderSortField('email', 'Email'),
            'created_at' => $this->renderSortField('created_at', 'Created at'),
            'actions'    => __('Actions')
        ];
    }
}
