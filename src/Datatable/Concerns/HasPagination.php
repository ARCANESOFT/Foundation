<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable\Concerns;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Class     HasPagination
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasPagination
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Get the current page.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return int
     */
    protected function getCurrentPage(Request $request): int
    {
        return (int) $request->get('page', 1);
    }

    /**
     * Get per page.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return int
     */
    protected function getPerPage(Request $request): int
    {
        $default = config('arcanesoft.foundation.datatable.per-page.default', 25);

        return (int) $request->get('per_page', $default);
    }

    /**
     * Get per page options.
     *
     * @return string[]
     */
    protected function getPerPageOptions(): array
    {
        return (array) config('arcanesoft.foundation.datatable.per-page.options', []);
    }

    /**
     * Convert the collection into paginator.
     *
     * @param  \Illuminate\Http\Request        $request
     * @param  \Illuminate\Support\Collection  $collection
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function paginateCollection(Request $request, Collection $collection)
    {
        $page = $this->getCurrentPage($request);
        $perPage = $this->getPerPage($request);

        return (new LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        ));
    }
    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the pagination's navigation links.
     *
     * @param  \Illuminate\Http\Request                     $request
     * @param  \Illuminate\Pagination\LengthAwarePaginator  $items
     *
     * @return array
     */
    protected function getPaginationLinks(Request $request, LengthAwarePaginator $items): array
    {
        return [
            'first' => $items->url(1),
            'last'  => $items->url($items->lastPage()),
            'next'  => $items->nextPageUrl(),
            'prev'  => $items->previousPageUrl(),
        ];
    }

    /**
     * Get the pagination's meta data.
     *
     * @param  \Illuminate\Http\Request                     $request
     * @param  \Illuminate\Pagination\LengthAwarePaginator  $items
     *
     * @return array
     */
    protected function getPaginationMetas(Request $request, LengthAwarePaginator $items): array
    {
        $allowed = [
            'current_page',
            'from',
            'last_page',
            'links',
            'path',
            'per_page',
            'to',
            'total',
        ];

        return array_merge(Arr::only($items->toArray(), $allowed), [
            'per_page' => [
                'selected' => $this->getPerPage($request),
                'options'  => $this->getPerPageOptions(),
            ],
        ]);
    }
}
