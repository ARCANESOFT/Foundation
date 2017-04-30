@section('header')
    <i class="fa fa-fw fa-map-signs"></i> {{ trans('foundation::route-viewer.titles.routes') }} <small>{{ trans('foundation::route-viewer.titles.routes-list') }}</small>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h2 class="box-title">{{ trans('foundation::route-viewer.titles.routes') }}</h2>
            <div class="box-tools">
                <span class="label label-info">{{ trans('core::pagination.total', ['total' => count($routes)]) }}</span>
            </div>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed table-hover no-margin">
                    <thead>
                        <tr>
                            <th>{{ trans('foundation::route-viewer.attributes.methods') }}</th>
                            <th>{{ trans('foundation::route-viewer.attributes.uri') }} / {{ trans('foundation::route-viewer.attributes.domain') }}</th>
                            <th>{{ trans('foundation::route-viewer.attributes.name') }} / {{ trans('foundation::route-viewer.attributes.action') }}</th>
                            <th>{{ trans('foundation::route-viewer.attributes.middleware') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($routes as $route)
                            <tr>
                                <td>
                                    @foreach ($route->methods as $method)
                                        <span class="label label-{{ $method['color'] }}">{{ $method['name'] }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <small>{!! preg_replace('#({[^}]+})#', '<span class="text-danger">$1</span>', $route->uri) !!}<br></small>
                                    @if ($route->domain)
                                        {{ $route->domain }}
                                    @else
                                        <span class="label label-default">--</span>
                                    @endif
                                </td>
                                <td>
                                    <small><b>N: </b> <span class="label label-{{ $route->hasName() ? 'primary' : 'default' }}">{{ $route->name }}</span></small>
                                    <br>
                                    <small>
                                        <b>A: </b> {!! preg_replace('#(@.*)$#', '<span class="text-success">$1</span>', $route->action) !!}
                                    </small>
                                </td>
                                <td>
                                    @foreach($route->middleware as $middleware)
                                        <span class="label label-inverse">{{ $middleware }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
