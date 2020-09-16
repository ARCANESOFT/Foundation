@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-users"></i> @lang('Users') <small>@lang('Metrics')</small>
@endsection

@push('content-nav')
    <div class="mt-2 mb-3 text-right">
        @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('metrics'))
        <a href="{{ route('admin::auth.users.metrics') }}" class="btn btn-sm btn-secondary {{ active(['admin::auth.users.metrics']) }}">@lang('Metrics')</a>
        @endcan

        @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('index'))
        <a href="{{ route('admin::auth.users.index') }}" class="btn btn-sm btn-secondary {{ active(['admin::auth.users.index']) }}">@lang('List of users')</a>
        @endcan

        @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('create'))
        {{ arcanesoft\ui\action_link('add', route('admin::auth.users.create'))->size('sm') }}
        @endcan
    </div>
@endpush

@section('content')
@endsection
