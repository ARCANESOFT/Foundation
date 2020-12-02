<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable;

use Arcanesoft\Foundation\Datatable\Concerns\{HasActions, HasColumns, HasFilters, HasPagination};
use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class     Datatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @method  \Illuminate\Database\Eloquent\Builder|\Illuminate\Support\Collection|mixed  handle(Request $request)
 */
abstract class Datatable implements Responsable
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasColumns;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Illuminate\Http\Request */
    private $request;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the request instance.
     *
     * @return \Illuminate\Http\Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Set the request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Get the search query.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string|null
     */
    protected function searchQuery(Request $request): ?string
    {
        $search = $request->input('query.search');

        return empty($search) ? null : $search;
    }

    /**
     * Get the transformer.
     *
     * @return \Arcanesoft\Foundation\Datatable\Contracts\Transformer
     */
    protected function transformer(): Transformer
    {
        return new ResourceTransformer;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        $this->setRequest($request);

        $items = $this->results($request);

        return new JsonResponse([
            'items' => $this->transformResults($request, $items),
            'links' => $this->getLinks($request, $items),
            'metas' => $this->getMetas($request, $items),
        ]);
    }

    /**
     * Get the results.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed|void
     */
    protected function results(Request $request)
    {
        $query = app()->call([$this, 'handle'], compact('request'));

        if ($query instanceof Builder)
            return $this->handleQuery($query, $request);

        if ($query instanceof Collection)
            return $this->handleCollection($query, $request);
    }

    /**
     * Handle the query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Http\Request               $request
     *
     * @return mixed
     */
    protected function handleQuery(Builder $query, Request $request)
    {
        $this->applySortByQuery($request, $query);

        if ($this->hasTrait(HasFilters::class))
            $query = $this->callMethod('applyFilters', [$request, $query]);

        if ($this->hasTrait(HasPagination::class))
            return $query->paginate(call_user_func_array([$this, 'getPerPage'], [$request]));

        return $query->get();
    }

    /**
     * Handle the collection.
     *
     * @param  \Illuminate\Support\Collection  $collection
     * @param  \Illuminate\Http\Request        $request
     *
     * @return mixed
     */
    protected function handleCollection(Collection $collection, Request $request)
    {
        if ($this->hasTrait(HasFilters::class))
            $collection = $this->callMethod('applyFilters', [$request, $collection]);

        $collection = $this->applySortByCollection($request, $collection);

        return $this->callTraitMethod(
            HasPagination::class,
            'paginateCollection',
            [$request, $collection],
            $collection
        );
    }

    /**
     * Transform the results.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed                     $items
     *
     * @return array
     */
    protected function transformResults(Request $request, $items): array
    {
        if ($items instanceof LengthAwarePaginator)
            $items = $items->getCollection();

        $transformer = $this->transformer();

        return $items->transform(function ($item) use ($request, $transformer) {
            $actions = $this->callTraitMethod(HasActions::class, 'transformActions', [$request, $item]);

            return array_merge(
                $transformer->transform($item, $request),
                array_filter(compact('actions'))
            );
        })->values()->toArray();
    }

    /**
     * Get the navigation links.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed                     $items
     *
     * @return array|null
     */
    protected function getLinks(Request $request, $items): ?array
    {
        return $this->callTraitMethod(HasPagination::class, 'getPaginationLinks', [$request, $items]);
    }

    /**
     * Get the response's `metas` data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   mixed                    $items
     *
     * @return array
     */
    protected function getMetas(Request $request, $items): array
    {
        return [
            'columns'    => $this->getColumnsMeta(),
            'query'      => [
                'sort_by'   => $this->getSortByMeta($request),
                'search'    => $this->searchQuery($request),
                'filter_by' => $this->callTraitMethod(HasFilters::class, 'filtersQuery', [$request], []),
            ],
            'filters'    => $this->callTraitMethod(HasFilters::class, 'getFiltersMeta', [$request]),
            'pagination' => $this->callTraitMethod(HasPagination::class, 'getPaginationMetas', [$request, $items]),
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Call a trait's method if used, otherwise return the default value.
     *
     * @param  string      $trait
     * @param  string      $method
     * @param  array       $params
     * @param  mixed|null  $default
     *
     * @return mixed|null
     */
    private function callTraitMethod(string $trait, string $method, array $params = [], $default = null)
    {
        return $this->hasTrait($trait)
            ? $this->callMethod($method, $params)
            : $default;
    }

    /**
     * Call a method.
     *
     * @param  string  $method
     * @param  array   $params
     *
     * @return false|mixed
     */
    private function callMethod(string $method, array $params = [])
    {
        return call_user_func_array([$this, $method], $params);
    }

    /**
     * Determine if the given trait was used.
     *
     * @param  string  $trait
     *
     * @return bool
     */
    private function hasTrait(string $trait): bool
    {
        return in_array($trait, class_uses($this));
    }
}
