<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Views\Components;

use Arcanedev\RouteViewer\Contracts\RouteViewer;
use Arcanedev\RouteViewer\Entities\Route;
use Arcanedev\RouteViewer\Entities\RouteCollection;
use Arcanesoft\Foundation\System\Policies\RouteViewerPolicy;
use Closure;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class     RoutesDatatable
 *
 * @package  Arcanesoft\Foundation\System\Views\Components
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoutesDatatable extends Datatable
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const NAME = 'foundation::system.routes-viewer.index';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    public $search = '';

    public $routeMethod = 'ALL';

    public $methods = [
        'ALL'   => 'ALL',
        'GET'    => 'GET',
        'POST'   => 'POST',
        'PUT'    => 'PUT',
        'DELETE' => 'DELETE',
    ];

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
        return $guard->allows(RouteViewerPolicy::ability('index'));
    }

    /**
     * Render the component.
     *
     * @param  \Arcanedev\RouteViewer\Contracts\RouteViewer  $routeViewer
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(RouteViewer $routeViewer)
    {
        return view('foundation::system.routes-viewer._datatables.index', [
            'routes' => $this->getResults($routeViewer),
            'fields' => $this->getFields(),
        ]);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the results.
     *
     * @param  \Arcanedev\RouteViewer\Contracts\RouteViewer  $routeViewer
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function getResults(RouteViewer $routeViewer): LengthAwarePaginator
    {
        $results = $routeViewer
            ->all()
            ->unless($this->routeMethod === 'ALL', $this->applyMethodFilter())
            ->unless(empty($this->search), $this->applySearchFilter());


        return $this->convertToPagination($results);
    }

    /**
     * Get the fields.
     *
     * @return array
     */
    private function getFields(): array
    {
        return [
            'method'     => __('Method'),
            'domain'     => __('Domain'),
            'details'    => __('URI').' / '.__('Name').' / '.__('Action'),
            'middleware' => __('Middleware'),
        ];
    }

    /**
     * Apply search filter.
     *
     * @return \Closure
     */
    private function applySearchFilter(): Closure
    {
        return function (RouteCollection $routes): RouteCollection {
            return $routes->filter(function (Route $route): bool {
                $needles   = explode(' ', Str::lower($this->search));
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
        };
    }

    /**
     * Apply the method filter.
     *
     * @return \Closure
     */
    private function applyMethodFilter(): Closure
    {
        return function (RouteCollection $routes): RouteCollection {
            return $routes->filter(function (Route $route): bool {
                $methods = Arr::pluck($route->methods, 'name');

                return in_array($this->routeMethod, $methods);
            });
        };
    }
}
