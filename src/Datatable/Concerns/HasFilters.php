<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable\Concerns;

use Arcanesoft\Foundation\Datatable\Contracts\Filter;
use Illuminate\Http\Request;

/**
 * Trait     HasFilters
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasFilters
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Defines the datatable's filters.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Arcanesoft\Foundation\Datatable\Contracts\Filter[]
     */
    abstract protected function filters(Request $request): array;

    /**
     * Get the filters metas.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    protected function getFiltersMeta(Request $request): array
    {
        return array_map(function (Filter $filter) {
            return $filter->toArray();
        }, $this->filters($request));
    }

    /**
     * Apply the defined filters for the given resources (query builder or collection instance).
     *
     * @param  \Illuminate\Http\Request                                                    $request
     * @param  \Illuminate\Database\Eloquent\Builder|\Illuminate\Support\Collection|mixed  $resources
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Support\Collection|mixed
     */
    protected function applyFilters(Request $request, $resources)
    {
        $filtered = $this->filtersQuery($request);

        if (empty($filtered))
            return $resources;

        foreach ($this->filters($request) as $filter) {
            if (isset($filtered[$filter->getName()])) {
                $resources = $filter->apply($resources, $filtered[$filter->getName()]);
            }
        }

        return $resources;
    }

    /**
     * Get the filters from request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    protected function filtersQuery(Request $request): array
    {
        $filters = $request->input('query.filter_by', []);

        return (array) $filters;
    }
}
