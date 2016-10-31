<div class="box">
    <div class="box-header">
        <h2 class="box-title">Application</h2>
    </div>
    <div class="box-body no-padding">
        <table class="table table-condensed table-hover no-margin">
            <tr>
                <th>Base URL</th>
                <td class="text-right">
                    <span class="label label-primary">{{ config('app.url') }}</span>
                </td>
            </tr>
            <tr>
                <th>Default Locale</th>
                <td class="text-right">
                    <span class="label label-primary">{{ strtoupper(config('app.locale')) }}</span>
                </td>
            </tr>
            <tr>
                <th>Timezone</th>
                <td class="text-right">
                    <span class="label label-primary">{{ config('app.timezone') }}</span>
                </td>
            </tr>
            <tr>
                <th>Debug Mode</th>
                <td class="text-right">
                    @if (config('app.debug', false))
                        <span class="label label-warning">Enabled</span>
                    @else
                        <span class="label label-success">Disabled</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Maintenance Mode</th>
                <td class="text-right">
                    @if (app()->isDownForMaintenance())
                        <span class="label label-warning">Enabled</span>
                    @else
                        <span class="label label-success">Disabled</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>ARCANESOFT</th>
                <td class="text-right">
                    <span class="label label-primary">version {{ foundation()->version() }}</span>
                </td>
            </tr>
        </table>
    </div>
</div>
