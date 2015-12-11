@section('header')
    <i class="fa fa-fw fa-book"></i> LogViewer
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-fw fa-dashboard"></i> Dashboard</h3>
            <div class="box-tools">
                <div class="btn-group">
                    <a href="{{ route('foundation::log-viewer.index') }}" class="btn btn-sm btn-default {{ route_is('foundation::log-viewer.index') ? 'active' : '' }}">
                        <i class="fa fa-fw fa-dashboard"></i> Dashboard
                    </a>
                    <a href="{{ route('foundation::log-viewer.logs.list') }}" class="btn btn-sm btn-default {{ route_is('foundation::log-viewer.logs.list') ? 'active' : '' }}">
                        <i class="fa fa-fw fa-list"></i> Logs list
                    </a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                @foreach($percents as $level => $item)
                    <div class="col-md-4">
                        <div class="info-box level level-{{ $level }} {{ $item['count'] === 0 ? 'level-empty' : '' }}">
                            <span class="info-box-icon">
                                {!! log_styler()->icon($level) !!}
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">{{ $item['name'] }}</span>
                                <span class="info-box-number">
                                    {{ $item['count'] }} entries - {!! $item['percent'] !!} %
                                </span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: {{ $item['percent'] }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
