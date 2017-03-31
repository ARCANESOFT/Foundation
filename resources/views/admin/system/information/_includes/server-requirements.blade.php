<div class="box">
    <div class="box-header">
        <h2 class="box-title">PHP</h2>
    </div>
    <div class="box-body no-padding">
        <table class="table table-condensed table-hover no-margin">
            <tr>
                <th>Version</th>
                <td class="text-right">
                    <span class="label label-primary">{{ phpversion() }}</span>
                </td>
            </tr>
            @foreach($requirements['php'] as $requirement => $enabled)
            <tr>
                <th>{{ ucfirst($requirement) }} Ext</th>
                <td class="text-right">
                    @if ($enabled)
                        <span class="label label-success"><i class="fa fa-fw fa-check"></i></span>
                    @else
                        <span class="label label-danger"><i class="fa fa-fw fa-times"></i></span>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="box">
    <div class="box-header">
        <h2 class="box-title">WebServer</h2>
    </div>
    <div class="box-body no-padding">
        <table class="table table-condensed table-hover no-margin">
            <tr>
                <th>Software</th>
                <td class="text-right">
                    {{ $_SERVER['SERVER_SOFTWARE'] }}
                </td>
            </tr>
            <tr>
                <th>SSL Installed</th>
                <td class="text-right">
                    @if ($requirements['server']['ssl'])
                        <span class="label label-success"><i class="fa fa-fw fa-check"></i></span>
                    @else
                        <span class="label label-danger"><i class="fa fa-fw fa-times"></i></span>
                    @endif
                </td>
            </tr>
            @foreach($requirements['server']['modules'] as $requirement => $enabled)
                <tr>
                    <th>{{ $requirement }}</th>
                    <td class="text-right">
                        @if ($enabled)
                            <span class="label label-success"><i class="fa fa-fw fa-check"></i></span>
                        @else
                            <span class="label label-danger"><i class="fa fa-fw fa-times"></i></span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
