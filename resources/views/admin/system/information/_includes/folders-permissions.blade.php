<div class="box">
    <div class="box-header">
        <h2 class="box-title">Folders Permissions</h2>
    </div>
    <div class="box-body no-padding">
        <table class="table table-condensed table-hover no-margin">
            @foreach ($permissions as $folder => $permission)
            <tr>
                <td>{{ $folder }}</td>
                <td class="text-right">
                    <span class="label label-{{ $permission['writable'] ? 'success' : 'danger' }}">
                        {{ $permission['chmod'] }}
                    </span>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
