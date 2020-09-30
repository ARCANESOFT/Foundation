<x-arc:card>
    <x-arc:card-header>@lang('Application')</x-arc:card-header>
    <x-arc:card-table>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('URL')</td>
            <td class="text-right small">{{ $applicationInfo['url'] }}</td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Locale')</td>
            <td class="text-right small">{{ $applicationInfo['locale'] }}</td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Timezone')</td>
            <td class="text-right small">{{ $applicationInfo['timezone'] }}</td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Debug Mode')</td>
            <td class="text-right">
                @if ($applicationInfo['debug_mode'])
                    <span class="badge border border-danger text-muted">
                        <i class="fas fa-fw fa-exclamation-triangle text-danger"></i> @lang('Enabled')
                    </span>
                @else
                    <span class="badge border border-success text-muted">@lang('Disabled')</span>
                @endif
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Maintenance Mode')</td>
            <td class="text-right">
                @if ($applicationInfo['maintenance_mode'])
                    <span class="badge border border-danger text-muted">
                        <i class="fas fa-fw fa-exclamation-triangle text-danger"></i> @lang('Enabled')
                    </span>
                @else
                    <span class="badge border border-success text-muted">@lang('Disabled')</span>
                @endif
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('PHP Version')</td>
            <td class="text-right">
                <span class="badge border border-muted text-muted">{{ $applicationInfo['php_version'] }}</span>
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Laravel Version')</td>
            <td class="text-right">
                <span class="badge border border-muted text-muted">{{ $applicationInfo['laravel_version'] }}</span>
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('ARCANESOFT Version')</td>
            <td class="text-right">
                <span class="badge border border-muted text-muted">{{ $applicationInfo['foundation_version'] }}</span>
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Database Driver')</td>
            <td class="text-right">
                <span class="badge border border-muted text-muted">{{ $applicationInfo['database_connection'] }}</span>
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Cache Driver')</td>
            <td class="text-right">
                <span class="badge border border-muted text-muted">{{ $applicationInfo['cache_driver'] }}</span>
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Session Driver')</td>
            <td class="text-right">
                <span class="badge border border-muted text-muted">{{ $applicationInfo['session_driver'] }}</span>
            </td>
        </tr>
    </x-arc:card-table>
</x-arc:card>
