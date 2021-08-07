<nav class="page-actions btn-seperated">
    @can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('metrics'))
        <x-arc:button-action
            type="metrics" action="{{ route('admin::cms.languages.metrics') }}"/>
    @endcan

    @can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('index'))
        <x-arc:button-action
            type="list" action="{{ route('admin::cms.languages.index') }}"/>
    @endcan

    @can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('create'))
        <x-arc:button-action
            type="create" action="{{ route('admin::cms.languages.create') }}"/>
    @endcan
</nav>
