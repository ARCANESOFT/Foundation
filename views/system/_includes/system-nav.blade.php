<div class="card shadow-sm mb-4">
    <div class="card-body p-2">
        <nav class="nav nav-pills nav-justified">
            @can(Arcanesoft\Foundation\System\Policies\InformationPolicy::ability('index'))
                <a href="{{ route('admin::system.index') }}"
                   class="nav-item nav-link {{ active(['admin::system.index']) }}">@lang('Information')</a>
            @endcan

            @can(Arcanesoft\Foundation\System\Policies\MaintenancePolicy::ability('index'))
                <a href="{{ route('admin::system.maintenance.index') }}"
                   class="nav-item nav-link {{ active(['admin::system.maintenance.*']) }}">@lang('Maintenance')</a>
            @endcan

            @can(Arcanesoft\Foundation\System\Policies\AbilitiesPolicy::ability('index'))
                <a href="{{ route('admin::system.abilities.index') }}"
                   class="nav-item nav-link {{ active(['admin::system.abilities.*']) }}">@lang('Abilities')</a>
            @endcan

            @can(Arcanesoft\Foundation\System\Policies\DependenciesPolicy::ability('index'))
                <a href="{{ route('admin::system.dependencies.index') }}"
                   class="nav-item nav-link {{ active(['admin::system.dependencies.*']) }}">@lang('Dependencies')</a>
            @endcan
        </nav>
    </div>
</div>
