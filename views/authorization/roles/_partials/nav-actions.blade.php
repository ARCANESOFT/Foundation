<nav class="page-actions btn-seperated">
    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('metrics'))
        <x-arc:button-action
            type="metrics" action="{{ route('admin::authorization.roles.metrics') }}"/>
    @endcan

    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('index'))
            <x-arc:button-action
                type="list" action="{{ route('admin::authorization.roles.index') }}"/>
    @endcan

    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('create'))
            <x-arc:button-action
                type="create" action="{{ route('admin::authorization.roles.create') }}"/>
    @endcan
</nav>
