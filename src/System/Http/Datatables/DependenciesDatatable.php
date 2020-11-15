<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Datatables;

use Arcanesoft\Foundation\Datatable\{Action, Column, Datatable};
use Arcanesoft\Foundation\Datatable\Concerns\{HasActions, HasPagination};
use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Arcanesoft\Foundation\PackageManifest;
use Arcanesoft\Foundation\System\Http\Transformers\DependencyTransformer;
use Arcanesoft\Foundation\System\Policies\DependenciesPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\{Collection, Str};

/**
 * Class     DependenciesDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DependenciesDatatable extends Datatable
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
     * @param  \Arcanesoft\Foundation\PackageManifest  $manifest
     * @param  \Illuminate\Http\Request                $request
     *
     * @return \Illuminate\Support\Collection
     */
    public function handle(PackageManifest $manifest, Request $request)
    {
        $dependencies = $manifest->installed();

        return $this->handleSearchQuery($dependencies, $request);
    }

    /**
     * Handle the search query.
     *
     * @param  \Illuminate\Support\Collection  $dependencies
     * @param  \Illuminate\Http\Request        $request
     *
     * @return \Illuminate\Support\Collection
     */
    protected function handleSearchQuery(Collection $dependencies, Request $request): Collection
    {
        $search = $this->searchQuery($request);

        if (empty($search))
            return $dependencies;

        return $dependencies->filter(function ($package) use ($search) {
            $needles   = explode(' ', Str::lower($search));
            $haystacks = [
                $package['name'],
            ];

            foreach ($haystacks as $haystack) {
                if (Str::contains(Str::lower($haystack), $needles))
                    return true;
            }

            return false;
        })->values();
    }

    /**
     * Define the datatable's columns.
     *
     * @return \Arcanesoft\Foundation\Datatable\Column[]
     */
    protected function columns(): array
    {
        return [
            Column::make('name', 'Name')->sortable(Column::SORT_ASC),
            Column::make('description', 'Description'),
            Column::make('version', 'Version')->align('center'),
        ];
    }

    /**
     * Define the datatable actions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array                     $package
     *
     * @return \Arcanesoft\Foundation\Datatable\Action[]
     */
    protected function actions(Request $request, $package): array
    {
        $name = $package['name'];

        return [
            Action::link('show', 'Show', function () use ($name) {
                return route('admin::system.dependencies.show', explode('/', $name));
            })->can(function () use ($name) {
                return DependenciesPolicy::can('show', [$name]);
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
        return new DependencyTransformer;
    }
}
