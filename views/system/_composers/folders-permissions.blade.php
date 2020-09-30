<x-arc:card>
    <x-arc:card-header>@lang('Folders Permissions')</x-arc:card-header>
    <x-arc:card-table>
        @foreach($foldersPermissions as $folder => $permission)
        <tr>
            <td class="font-weight-light text-monospace text-muted small">{{ $folder }}</td>
            <td class="text-right">
                @if ($permission['writable'])
                    <span class="badge border border-success text-muted mr-1">{{ $permission['chmod'] }}</span>
                    <span class="badge border border-success text-success"><i class="fa fa-fw fa-check"></i></span>
                @else
                    <span class="badge border border-danger text-muted mr-1">{{ $permission['chmod'] }}</span>
                    <span class="badge border border-danger text-danger"><i class="fa fa-fw fa-times"></i></span>
                @endif
            </td>
        </tr>
        @endforeach
    </x-arc:card-table>
</x-arc:card>
