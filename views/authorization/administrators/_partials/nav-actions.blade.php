<nav class="page-actions btn-separated">
    @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('metrics'))
        <x-arc:button-action
            type="metrics" action="{{ route('admin::authorization.administrators.metrics') }}"/>
    @endcan

    @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('index'))
        <x-arc:button-action
            type="list" action="{{ route('admin::authorization.administrators.index') }}"/>
    @endcan

    @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('create'))
        <x-arc:button-action
            type="create" action="{{ route('admin::authorization.administrators.create') }}"/>
    @endcan
</nav>
