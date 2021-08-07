<nav class="btn-seperated page-actions">
    @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('metrics'))
        <x-arc:button-action
            type="metrics" action="{{ route('admin::cms.categories.metrics') }}"/>
    @endcan

    @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('index'))
        <x-arc:button-action
            type="list" action="{{ route('admin::cms.categories.index') }}"/>

        <x-arc:button-action
            type="tree" action="{{ route('admin::cms.categories.tree') }}"/>
    @endcan

    @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('create'))
        <x-arc:button-action
            type="create" action="{{ route('admin::cms.categories.create') }}"/>
    @endcan
</nav>
