<div class="box">
    <div class="box-header">
        <h2 class="box-title">PHP</h2>
    </div>
    <div class="box-body no-padding">
        <table class="table table-condensed table-hover no-margin">
            <tr>
                <th>Version</th>
                <td class="text-right">
                    <span class="label label-primary">{{ $phpInfo['version'] }}</span>
                </td>
            </tr>
            @foreach($phpInfo['requirements'] as $requirement => $enabled)
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
    <div class="box-header with-border">
        <h2 class="box-title">PHP Loaded Extensions</h2>
    </div>
    <div class="box-body">
        @foreach($phpInfo['extensions'] as $extension)
            <span class="label label-default">{{ $extension }}</span>
        @endforeach
    </div>
</div>
