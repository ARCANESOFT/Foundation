<x-arc:card>
    <x-arc:card-header>@lang('Application')</x-arc:card-header>
    <x-arc:card-table>
        <tr>
            <x-arc:table-th label="URL"/>
            <td class="text-end small">{{ $applicationInfo['url'] }}</td>
        </tr>
        <tr>
            <x-arc:table-th label="Locale"/>
            <td class="text-end small">{{ $applicationInfo['locale'] }}</td>
        </tr>
        <tr>
            <x-arc:table-th label="Timezone"/>
            <td class="text-end small">{{ $applicationInfo['timezone'] }}</td>
        </tr>
        <tr>
            <x-arc:table-th label="Debug Mode"/>
            <td class="text-end">
                @if ($applicationInfo['debug_mode'])
                    <x-arc:badge type="danger">
                        <i class="fas fa-fw fa-exclamation-triangle text-danger me-1"></i> @lang('Enabled')
                    </x-arc:badge>
                @else
                    <x-arc:badge type="success">@lang('Disabled')</x-arc:badge>
                @endif
            </td>
        </tr>
        <tr>
            <x-arc:table-th label="Maintenance Mode"/>
            <td class="text-end">
                @if ($applicationInfo['maintenance_mode'])
                    <x-arc:badge type="danger">
                        <i class="fas fa-fw fa-exclamation-triangle text-danger me-1"></i> @lang('Enabled')
                    </x-arc:badge>
                @else
                    <x-arc:badge type="success">@lang('Disabled')</x-arc:badge>
                @endif
            </td>
        </tr>
        <tr>
            <x-arc:table-th label="PHP Version"/>
            <td class="text-end">
                <x-arc:badge type="muted">{{ $applicationInfo['php_version'] }}</x-arc:badge>
            </td>
        </tr>
        <tr>
            <x-arc:table-th label="Laravel Version"/>
            <td class="text-end">
                <x-arc:badge type="muted">{{ $applicationInfo['laravel_version'] }}</x-arc:badge>
            </td>
        </tr>
        <tr>
            <x-arc:table-th label="ARCANESOFT Version"/>
            <td class="text-end">
                <x-arc:badge type="muted">{{ $applicationInfo['foundation_version'] }}</x-arc:badge>
            </td>
        </tr>
        <tr>
            <x-arc:table-th label="Database Driver"/>
            <td class="text-end">
                <x-arc:badge type="muted">{{ $applicationInfo['database_connection'] }}</x-arc:badge>
            </td>
        </tr>
        <tr>
            <x-arc:table-th label="Cache Driver"/>
            <td class="text-end">
                <x-arc:badge type="muted">{{ $applicationInfo['cache_driver'] }}</x-arc:badge>
            </td>
        </tr>
        <tr>
            <x-arc:table-th label="Session Driver"/>
            <td class="text-end">
                <x-arc:badge type="muted">{{ $applicationInfo['session_driver'] }}</x-arc:badge>
            </td>
        </tr>
    </x-arc:card-table>
</x-arc:card>
