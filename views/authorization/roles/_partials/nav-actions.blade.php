<nav class="page-actions">
    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('metrics'))
        <a href="{{ route('admin::authorization.roles.metrics') }}"
           class="btn btn-sm btn-secondary {{ active(['admin::authorization.roles.metrics']) }}">@lang('Metrics')</a>
    @endcan

    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('index'))
        <a href="{{ route('admin::authorization.roles.index') }}"
           class="btn btn-sm btn-secondary {{ active(['admin::authorization.roles.index']) }}">@lang('List')</a>
    @endcan

    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('create'))
        <a href="{{ route('admin::authorization.roles.create') }}"
           class="btn btn-primary btn-sm"><i class="fa fa-fw fa-plus"></i> @lang('Add')</a>
    @endcan
</nav>
