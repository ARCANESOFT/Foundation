<div class="card card-borderless shadow-sm">
    <div class="card-header px-2 font-weight-light text-uppercase text-muted">
        @lang('Folders Permissions')
    </div>
    <table class="table table-borderless mb-0">
        @foreach($foldersPermissions as $folder => $permission)
        <tr>
            <td class="font-weight-light text-monospace text-muted small">{{ $folder }}</td>
            <td class="text-right">
                @if ($permission['writable'])
                    <span class="badge border border-success text-muted">{{ $permission['chmod'] }}</span>
                    <span class="badge border border-success text-success"><i class="fa fa-fw fa-check"></i></span>
                @else
                    <span class="badge border border-danger text-muted">{{ $permission['chmod'] }}</span>
                    <span class="badge border border-danger text-danger"><i class="fa fa-fw fa-times"></i></span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
