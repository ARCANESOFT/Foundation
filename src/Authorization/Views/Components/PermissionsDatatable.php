<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Views\Components;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Policies\PermissionsPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\PermissionsRepository;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class     PermissionsDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsDatatable extends DatatableComponent
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const NAME = 'foundation::authorization.permissions.index';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    public $sortField = 'group';

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
        return $guard->allows(PermissionsPolicy::ability('index'));
    }

    /**
     * Render the component.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\PermissionsRepository  $repo
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(PermissionsRepository $repo)
    {
        return view('foundation::authorization.permissions._datatables.index', [
            'permissions' => $this->getResults($repo),
            'fields'      => $this->prepareFields(),
        ]);
    }

    /**
     * Get the results.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\PermissionsRepository  $repo
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function getResults(PermissionsRepository $repo): LengthAwarePaginator
    {
        $permissionTable = Auth::table('permissions');
        $groupsTable = Auth::table('permissions-groups');

        return $repo
            ->with(['group'])
            ->withCount(['roles'])
            ->join($groupsTable, "{$permissionTable}.group_id", '=', "{$groupsTable}.id")
            ->unless(empty($this->search), function (Builder $query) use ($permissionTable, $groupsTable) {
                $query
                    ->where("{$groupsTable}.name", 'like', '%'.$this->search.'%')
                    ->orWhere("{$permissionTable}.category", 'like', '%'.$this->search.'%')
                    ->orWhere("{$permissionTable}.name", 'like', '%'.$this->search.'%');
            })
            ->unless(empty($this->sortField), function (Builder $query) use ($permissionTable, $groupsTable) {
                $sortField = $this->sortField === 'group'
                    ? "{$groupsTable}.name"
                    : "{$permissionTable}.{$this->sortField}";

                $query->orderBy($sortField, $this->getSortDirection());
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
            'group'       => $this->renderSortField('group', 'Group'),
            'category'    => $this->renderSortField('category', 'Category'),
            'name'        => $this->renderSortField('name', 'Name'),
            'description' => __('Description'),
            'roles'       => __('Roles'),
            'actions'     => __('Actions'),
        ];
    }
}
