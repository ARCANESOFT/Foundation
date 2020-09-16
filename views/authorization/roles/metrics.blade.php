@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-user-tag"></i> @lang('Roles') <small>@lang('Metrics')</small>
@endsection

@push('content-nav')
    <div class="mt-2 mb-3 text-right">
        @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('metrics'))
        <a href="{{ route('admin::auth.roles.metrics') }}" class="btn btn-sm btn-secondary {{ active(['admin::auth.roles.metrics']) }}">@lang('Metrics')</a>
        @endcan

        @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('index'))
        <a href="{{ route('admin::auth.roles.index') }}" class="btn btn-sm btn-secondary {{ active(['admin::auth.roles.index']) }}">@lang('List of roles')</a>
        @endcan

        @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('create'))
        {{ arcanesoft\ui\action_link('add', route('admin::auth.roles.create'))->size('sm') }}
        @endcan
    </div>
@endpush

@section('content')
@endsection
