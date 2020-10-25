<?php /** @var  Arcanedev\RouteViewer\Entities\Route[]|Illuminate\Contracts\Pagination\LengthAwarePaginator  $routes */ ?>

<div class="card card-borderless shadow-sm">
    @if ($routes->isNotEmpty())
        <div class="card-header px-2">
            <div class="row g-3">
                <div class="col-sm-4 col-md-3 col-xl-2 col-xxl-1">
                    @include('foundation::_includes.datatable.per-page-select')
                </div>
                <div class="col-sm-4 col-md-3 col-xl-2 col-xxl-1">
                    <div class="input-group">
                        <label class="input-group-text" for="routeMethod">@lang('METHOD')</label>
                        {{ form()->select('routeMethod', $methods, $routeMethod, ['arc:model' => 'routeMethod', 'class' => 'form-select']) }}
                    </div>
                </div>
                <div class="col-sm-4 col-md-6 col-xl-8 col-xxl-10">
                    @include('foundation::_includes.datatable.search-input')
                </div>
            </div>
        </div>
        <table class="table table-borderless table-hover mb-0">
            <thead>
            <tr>
                <th class="font-weight-light text-uppercase text-muted">{{ $fields['method'] }}</th>
                <th class="font-weight-light text-uppercase text-muted">{{ $fields['method'] }}</th>
                <th class="font-weight-light text-uppercase text-muted">{{ $fields['details'] }}</th>
                <th class="font-weight-light text-uppercase text-muted">{{ $fields['middleware'] }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($routes as $route)
                <tr>
                    <td>
                        @foreach ($route->methods as $method)
                            <span class="badge border border-{{ $method['color'] }} text-{{ $method['color'] }}">{{ $method['name'] }}</span>
                        @endforeach
                    </td>
                    <td>
                        <span class="badge badge-outline-secondary">{{ $route->domain ?? '--' }}</span>
                    </td>
                    <td class="small">
                        <span class="font-monospace">
                            {!! preg_replace('#({[^}]+})#', '<span class="text-danger">$1</span>', $route->uri) !!}
                        </span>
                        <br>
                        <span class="font-weight-semibold">{{ $route->hasName() ? $route->name : '--' }}</span>
                        <br>
                        @if ($route->isClosure())
                            <span class="label label-default">{{ $route->action }}</span>
                        @else
                            <span class="font-monospace">
                                {!! preg_replace('#(@.*)$#', '<span class="text-success">$1</span>', $route->action) !!}
                            </span>
                        @endif
                    </td>
                    <td>
                        @foreach($route->middleware as $middleware)
                            <span class="badge border border-secondary text-secondary">{{ $middleware }}</span>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="card-footer px-2">
            @include('foundation::_includes.datatable.datatable-footer', ['paginator' => $routes])
        </div>
    @else
        @include('foundation::_partials.no-data-found')
    @endif
</div>
