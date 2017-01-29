<div class="box">
    <div class="box-header">
        <h2 class="box-title">PHP</h2>
        <div class="box-tools">
            <span class="label label-primary">Version: {{ phpversion() }}</span>
        </div>
    </div>
    <div class="box-body no-padding">
        <table class="table table-condensed table-hover no-margin">
            <tr>
                <th>Loaded Extensions</th>
                <td>
                    @foreach(get_loaded_extensions() as $extension)
                        <span class="label label-inverse" style="display: inline-block;">{{ $extension }}</span>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
</div>
