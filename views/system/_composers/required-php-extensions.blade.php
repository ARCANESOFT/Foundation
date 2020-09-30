<x-arc:card>
    <x-arc:card-header>@lang('Required PHP Extensions')</x-arc:card-header>
    <x-arc:card-table>
        @foreach($requiredPhpExtensions as $extension => $loaded)
        <tr>
            <td class="text-monospace text-muted small">{{ $extension }}</td>
            <td class="text-right">
                @if ($loaded)
                    <span class="badge border border-success text-success">
                        <i class="fas fa-fw fa-check"></i>
                    </span>
                @else
                    <span class="badge border border-danger text-danger">
                        <i class="fas fa-fw fa-times"></i>
                    </span>
                @endif
            </td>
        </tr>
        @endforeach
    </x-arc:card-table>
</x-arc:card>
