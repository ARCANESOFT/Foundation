@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-users"></i> @lang('Users') <small>@lang('Metrics')</small>
@endsection

@push('content-nav')
    <div class="mt-2 mb-3 text-right">
        @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('metrics'))
        <a href="{{ route('admin::authorization.users.metrics') }}" class="btn btn-sm btn-secondary {{ active(['admin::authorization.users.metrics']) }}">
            @lang('Metrics')
        </a>
        @endcan

        @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('index'))
            <a href="{{ route('admin::authorization.users.index') }}" class="btn btn-sm btn-secondary {{ active(['admin::authorization.users.index']) }}">
                @lang('List of users')
            </a>
        @endcan

        @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('create'))
            <a href="{{ route('admin::authorization.users.create') }}" class="btn btn-primary btn-sm ml-1">
                <i class="fa fa-fw fa-plus"></i> @lang('Add')
            </a>
        @endcan
    </div>
@endpush

@section('content')
@endsection
