<nav class="page-actions btn-seperated">
    @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('metrics'))
        <x-arc:button-action
            type="metrics" action="{{ route('admin::authorization.users.metrics') }}"/>
    @endcan

    @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('index'))
        <x-arc:button-action
            type="list" action="{{ route('admin::authorization.users.index') }}"/>
    @endcan

    @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('create'))
        <x-arc:button-action
            type="create" action="{{ route('admin::authorization.users.create') }}"/>
    @endcan
</nav>
