<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable\Concerns;

use Arcanesoft\Foundation\Datatable\Column;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Trait     HasColumns
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasColumns
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Define the datatable's columns.
     *
     * @return \Arcanesoft\Foundation\Datatable\Column[]
     */
    abstract protected function columns(): array;

    /**
     * Apply the sort by columns on the given query builder.
     *
     * @param  \Illuminate\Http\Request               $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applySortByQuery(Request $request, Builder $query): Builder
    {
        $columns = $this->getSortedByFromRequest($request);

        foreach ($columns as $column) {
            app()->call(
                $column->hasSortQuery() ? $column->getSortQuery() : $this->getDefaultSortByForQuery(),
                compact('query', 'column', 'request')
            );
        }

        return $query;
    }

    /**
     * Get the default sort by callback for query builder.
     *
     * @return \Closure
     */
    protected function getDefaultSortByForQuery(): Closure
    {
        return function (Builder $query, Column $column) {
            return $query->orderBy($column->key(),$column->getSortDirection() ?: Column::SORT_ASC);
        };
    }

    /**
     * Apply the sort by columns on the given collection.
     *
     * @param  \Illuminate\Http\Request        $request
     * @param  \Illuminate\Support\Collection  $collection
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Collection
     */
    protected function applySortByCollection(Request $request, Collection $collection): Collection
    {
        $columns = $this->getSortedByFromRequest($request);

        foreach ($columns as $column) {
            $collection = app()->call(
                $column->hasSortQuery() ? $column->getSortQuery() : $this->getDefaultSortByForCollection(),
                compact('collection', 'column', 'request')
            );
        }

        return $collection;
    }

    /**
     * Get the default sort by callback for collection.
     *
     * @return \Closure
     */
    protected function getDefaultSortByForCollection(): Closure
    {
        return function (Collection $collection, Column $column, Request $request) {
            return $collection->sortBy(
                $column->key(),
                SORT_REGULAR,
                $column->getSortDirection() === Column::SORT_DESC
            )->values();
        };
    }

    /**
     * Get the columns meta.
     *
     * @return array
     */
    protected function getColumnsMeta(): array
    {
        $columns = array_map(function (Column $column)  {
            return $column->toArray();
        }, $this->columns());

        if ($this->hasTrait(HasActions::class))
            $columns[] = $this->getActionsColumnMeta();

        return $columns;
    }

    /**
     * Get the actions column meta.
     *
     * @return array
     */
    protected function getActionsColumnMeta(): array
    {
        return Column::make('actions', 'Actions', Column::DATATYPE_ACTIONS)
            ->align('right')
            ->toArray();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Define the datatable's "sort by columns".
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Arcanesoft\Foundation\Datatable\Column[]
     */
    protected function getSortedByFromRequest(Request $request): array
    {
        if ( ! $request->has('query.sort_by')) {
            return $this->getSortedByFallback($request);
        }

        $columns = $this->getSortableColumns();
        $sortedColumns = (array) $request->input('query.sort_by', []);

        $results = array_map(function (array $sortedColumn) use ($columns): ?Column {
            foreach ($columns as $column) {
                if ($sortedColumn['key'] === $column->key())
                    return $column->sortDirection($sortedColumn['direction']);
            }

            return null;
        }, $sortedColumns);

        return array_filter($results);
    }

    /**
     * Get the 'sort_by' meta.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    protected function getSortByMeta(Request $request): array
    {
        $columns = array_map(function (Column $column) {
            return [
                'key'       => $column->key(),
                'direction' => $column->getSortDirection(),
            ];
        }, $this->getSortedByFromRequest($request));

        return array_values($columns);
    }

    /**
     * Get the datatable's fallback "sort by columns".
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Arcanesoft\Foundation\Datatable\Column[]
     */
    protected function getSortedByFallback(Request $request): array
    {
        return $this->getSortableColumns(true);
    }

    /**
     * Get only the sortable columns.
     *
     * @param  bool  $withDirection
     *
     * @return \Arcanesoft\Foundation\Datatable\Column[]
     */
    protected function getSortableColumns(bool $withDirection = false): array
    {
        $columns = array_filter($this->columns(), function (Column $column) use ($withDirection) {
            return $withDirection
                ? ($column->isSortable() && $column->hasSortByDirection())
                : $column->isSortable();
        });

        return array_values($columns);
    }
}
