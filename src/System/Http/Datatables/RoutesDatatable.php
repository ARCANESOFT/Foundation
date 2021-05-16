<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Datatables;

use Arcanedev\RouteViewer\Entities\{Route, RouteCollection};
use Arcanedev\RouteViewer\RouteViewer;
use Arcanesoft\Foundation\Datatable\{Column, Datatable, Filter};
use Arcanesoft\Foundation\Datatable\Concerns\{HasFilters, HasPagination};
use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Arcanesoft\Foundation\System\Http\Transformers\RouteTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\{Arr, Str};

/**
 * Class     RoutesDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoutesDatatable extends Datatable
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasFilters;
    use HasPagination;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the datatable.
     *
     * @param  \Arcanedev\RouteViewer\RouteViewer  $routeViewer
     * @param  \Illuminate\Http\Request            $request
     *
     * @return \Arcanedev\RouteViewer\Entities\RouteCollection
     */
    public function handle(RouteViewer $routeViewer, Request $request)
    {
        $routes = $routeViewer->all();

        return $this->handleSearchQuery($routes, $request)->values();
    }

    /**
     * Handle the search query.
     *
     * @param  \Arcanedev\RouteViewer\Entities\RouteCollection  $routes
     * @param  \Illuminate\Http\Request                         $request
     *
     * @return \Arcanedev\RouteViewer\Entities\RouteCollection
     */
    protected function handleSearchQuery(RouteCollection $routes, Request $request): RouteCollection
    {
        $search = $this->searchQuery($request);

        if (empty($search))
            return $routes;

        return $routes->filter(function (Route $route) use ($search): bool {
            $needles   = explode(' ', Str::lower($search));
            $haystacks = [
                $route->uri,
                $route->action,
                $route->name,
            ];

            foreach ($haystacks as $haystack) {
                if (Str::contains(Str::lower($haystack), $needles))
                    return true;
            }

            return false;
        });
    }

    /**
     * Define the datatable's columns.
     *
     * @return \Arcanesoft\Foundation\Datatable\Column[]
     */
    protected function columns(): array
    {
        return [
            Column::make('methods', 'Methods', Column::DATATYPE_TAGS),
            Column::make('domain', 'Domain'),
            Column::make('details', 'Details', Column::DATATYPE_DESCRIPTION_LIST),
            Column::make('middleware', 'Middleware', Column::DATATYPE_TAGS)->align('right'),
        ];
    }

    /**
     * Defines the datatable's filters.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Arcanesoft\Foundation\Datatable\Contracts\Filter[]
     */
    protected function filters(Request $request): array
    {
        return [
            Filter::select('methods', 'Methods', 'all', [
                'all'    => 'ALL',
                'GET'    => 'GET',
                'POST'   => 'POST',
                'PUT'    => 'PUT',
                'DELETE' => 'DELETE',
            ])->query(function (RouteCollection $routes, string $value) {
                return $routes->filter(function (Route $route) use ($value) {
                    $methods = Arr::pluck($route->methods, 'name');

                    return in_array($value, $methods);
                })->values();
            }),
        ];
    }

    /**
     * Get the transformer.
     *
     * @return \Arcanesoft\Foundation\Datatable\Contracts\Transformer
     */
    protected function transformer(): Transformer
    {
        return new RouteTransformer;
    }
}
