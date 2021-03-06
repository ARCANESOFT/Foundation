@section('header')
    <i class="fa fa-fw fa-book"></i> LogViewer
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-fw fa-dashboard"></i> {{ trans('foundation::log-viewer.titles.dashboard') }}</h3>
            <div class="box-tools">
                <div class="btn-group">
                    @can(Arcanesoft\Foundation\Policies\LogViewerPolicy::PERMISSION_DASHBOARD)
                    <a href="{{ route('admin::foundation.system.log-viewer.index') }}" class="btn btn-xs btn-default {{ route_is('admin::foundation.system.log-viewer.index') ? 'active' : '' }}">
                        <i class="fa fa-fw fa-dashboard"></i> {{ trans('foundation::log-viewer.titles.dashboard') }}
                    </a>
                    @endcan

                    @can(Arcanesoft\Foundation\Policies\LogViewerPolicy::PERMISSION_LIST)
                    <a href="{{ route('admin::foundation.system.log-viewer.logs.list') }}" class="btn btn-xs btn-default {{ route_is('admin::foundation.system.log-viewer.logs.list') ? 'active' : '' }}">
                        <i class="fa fa-fw fa-list"></i> {{ trans('foundation::log-viewer.titles.logs-list') }}
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="box-body">
            @if (count($percents))
                <div class="row">
                    @foreach($percents as $level => $item)
                        <div class="col-md-4">
                            <div class="info-box level level-{{ $level }} {{ $item['count'] === 0 ? 'level-empty' : '' }}">
                                <span class="info-box-icon">{!! log_styler()->icon($level) !!}</span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{ $item['name'] }}</span>
                                    <span class="info-box-number">
                                        {{ trans('foundation::log-viewer.entries-stats', ['count' => $item['count'], 'percent' => $item['percent']]) }}
                                    </span>

                                    <div class="progress">
                                        <div class="progress-bar" style="width: {{ $item['percent'] }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <span class="label label-default">{{ trans('foundation::log-viewer.no-entries') }}</span>
            @endif
        </div>
    </div>
@endsection

@section('scripts')

@endsection
