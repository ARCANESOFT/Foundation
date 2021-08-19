<x-arc:card>
    <x-arc:card-header>@lang('Required PHP Extensions')</x-arc:card-header>
    <x-arc:card-table hover>
        @foreach($requiredPhpExtensions as $extension => $loaded)
        <tr>
            <td class="text-monospace text-muted small">{{ $extension }}</td>
            <td class="text-end">
                <x-arc:badge-active :active="$loaded" icon/>
            </td>
        </tr>
        @endforeach
    </x-arc:card-table>
</x-arc:card>
