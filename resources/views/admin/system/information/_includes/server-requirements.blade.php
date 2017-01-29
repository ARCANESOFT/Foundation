<div class="box">
    <div class="box-header">
        <h2 class="box-title">PHP Requirements</h2>
    </div>
    <div class="box-body no-padding">
        <table class="table table-condensed table-hover no-margin">
            @foreach($requirements['php'] as $requirement => $enabled)
                <tr>
                    <td>{{ ucfirst($requirement) }}</td>
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
        <h2 class="box-title">APACHE Requirements</h2>
    </div>
    <div class="box-body no-padding">
        <table class="table table-condensed table-hover no-margin">
            @foreach($requirements['apache'] as $requirement => $enabled)
                <tr>
                    <td>{{ ucfirst($requirement) }}</td>
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
