@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-user-secret"></i> @lang('Administrators') <small>@lang('Metrics')</small>
@endsection

@push('content-nav')
    <div class="mt-2 mb-3 text-right">
        @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('metrics'))
        <a href="{{ route('admin::auth.administrators.metrics') }}" class="btn btn-sm btn-secondary {{ active(['admin::auth.administrators.metrics']) }}">@lang('Metrics')</a>
        @endcan

        @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('index'))
        <a href="{{ route('admin::auth.administrators.index') }}" class="btn btn-sm btn-secondary {{ active(['admin::auth.administrators.index']) }}">@lang('List of administrators')</a>
        @endcan

        @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('create'))
        {{ arcanesoft\ui\action_link('add', route('admin::auth.administrators.create'))->size('sm') }}
        @endcan
    </div>
@endpush

@section('content')
@endsection
