<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Views\Components;

use Arcanesoft\Foundation\PackageManifest;
use Arcanesoft\Foundation\System\Policies\DependenciesPolicy;
use Arcanesoft\Foundation\Views\Concerns\WithSortField;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class     DependenciesDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DependenciesDatatable extends Datatable
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const NAME = 'foundation::system.dependencies.index';

    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use WithSortField;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    public $sortField = 'name';

    public $search = '';

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
        return $guard->allows(DependenciesPolicy::ability('index'));
    }

    /**
     * Render the component.
     *
     * @param \Arcanesoft\Foundation\PackageManifest $manifest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(PackageManifest $manifest)
    {
        return view('foundation::system.dependencies._datatables.index', [
            'packages' => $this->getResults($manifest),
            'fields'   => $this->getFields(),
        ]);
    }

    /**
     * Get the results.
     *
     * @param  \Arcanesoft\Foundation\PackageManifest  $manifest
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function getResults(PackageManifest $manifest): LengthAwarePaginator
    {
        $packages = $manifest->installed()
            ->unless(empty($this->search), function (Collection $items) {
                return $items->filter(function ($package) {
                    $needles   = explode(' ', Str::lower($this->search));
                    $haystacks = [
                        $package['name'],
                    ];

                    foreach ($haystacks as $haystack) {
                        if (Str::contains(Str::lower($haystack), $needles))
                            return true;
                    }

                    return false;
                });
            })
            ->sortBy(function ($package) {
                if ($this->sortField === 'name')
                    return $package['name'];

                return $package['name'];
            }, SORT_REGULAR, ! $this->sortAsc)
            ->transform(function ($package) {
                return $package + [
                    'key' => str_replace('/', '+', $package['name']),
                ];
            });


        return $this->convertToPagination($packages);
    }

    /**
     * Get the fields.
     *
     * @return array
     */
    private function getFields(): array
    {
        return [
            'name'        => $this->renderSortField('name', __('Name')),
            'description' => __('Description'),
            'version'     => __('Version'),
            'actions'     => __('Actions'),
        ];
    }
}
