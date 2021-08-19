<x-arc:card>
    <x-arc:card-header>@lang('Folders Permissions')</x-arc:card-header>
    <x-arc:card-table hover>
        @foreach($foldersPermissions as $folder => $permission)
        <tr>
            <td class="font-weight-light text-monospace text-muted small">{{ $folder }}</td>
            <td class="text-end">
                <x-arc:badge :type="$permission['writable'] ? 'success' : 'danger'"
                             class="me-1">{{ $permission['chmod'] }}</x-arc:badge>
                <x-arc:badge-active :active="$permission['writable']" icon/>
            </td>
        </tr>
        @endforeach
    </x-arc:card-table>
</x-arc:card>
