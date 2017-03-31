<div class="box">
    <div class="box-header">
        <h2 class="box-title">Application</h2>
    </div>
    <div class="box-body no-padding">
        <table class="table table-condensed table-hover no-margin">
            <tr>
                <th>Base URL</th>
                <td class="text-right">
                    <span class="label label-primary">{{ $application['url'] }}</span>
                </td>
            </tr>
            <tr>
                <th>Default Locale</th>
                <td class="text-right">
                    <span class="label label-primary">{{ $application['locale'] }}</span>
                </td>
            </tr>
            <tr>
                <th>Timezone</th>
                <td class="text-right">
                    <span class="label label-primary">{{ $application['timezone'] }}</span>
                </td>
            </tr>
            <tr>
                <th>Debug Mode</th>
                <td class="text-right">
                    @if ($application['debug_mode'])
                        <span class="label label-danger">Enabled</span>
                    @else
                        <span class="label label-success">Disabled</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Maintenance Mode</th>
                <td class="text-right">
                    @if ($application['maintenance_mode'])
                        <span class="label label-warning">Enabled</span>
                    @else
                        <span class="label label-success">Disabled</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Application size</th>
                <td class="text-right">
                    <span class="label label-primary">{{ $application['app_size'] }}</span>
                </td>
            </tr>
            <tr>
                <th>ARCANESOFT <small>version</small></th>
                <td class="text-right">
                    <span class="label label-primary">{{ $application['arcanesoft_version'] }}</span>
                </td>
            </tr>
            <tr>
                <th>Laravel <small>version</small></th>
                <td class="text-right">
                    <span class="label label-primary">{{ $application['laravel_version'] }}</span>
                </td>
            </tr>
            <tr>
                <th>Database</th>
                <td class="text-right">
                    <span class="label label-inverse">{{ $application['database_connection'] }}</span>
                </td>
            </tr>
            <tr>
                <th>Cache</th>
                <td class="text-right">
                    <span class="label label-inverse">{{ $application['cache_driver'] }}</span>
                </td>
            </tr>
            <tr>
                <th>Session</th>
                <td class="text-right">
                    <span class="label label-inverse">{{ $application['session_driver'] }}</span>
                </td>
            </tr>
        </table>
    </div>
</div>
