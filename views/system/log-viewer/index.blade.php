<x-arc:layout>
    @section('page-title')
        <i class="fas fa-fw fa-clipboard-list"></i> @lang('LogViewer')
    @endsection

    <x-arc:card>
        <x-arc:card-header>@lang('Logs')</x-arc:card-header>
        <x-arc:card-table>
            <thead>
                <tr>
                    @foreach($headers as $key => $header)
                        <x-arc:table-th
                            label="{{ $header }}" scope="col"
                            class="{{ $key === 'date' ? 'text-left' : 'text-center' }}"/>
                    @endforeach
                    <x-arc:table-th label="Actions" scope="col" class="text-end"/>
                </tr>
            </thead>
            <tbody>
            @forelse($rows as $date => $row)
                <tr>
                    @foreach($row as $key => $value)
                        <td class="small {{ $key === 'date' ? 'text-left' : 'text-center' }}">
                            @if ($key == 'date')
                                <span class="text-muted">{{ $value }}</span>
                            @elseif ($value === 0)
                                <span class="text-muted">-</span>
                            @else
                                <span class="badge border border-log-level-{{ $key }} text-muted">{{ $value }}</span>
                            @endif
                        </td>
                    @endforeach
                    <td class="text-end">
                        {{-- SHOW --}}
                        <x-arc:datatable-action
                            type="show"
                            action="{{ route('admin::system.log-viewer.logs.show', [$date]) }}"
                            allowed="{{ Arcanesoft\Foundation\System\Policies\LogViewerPolicy::can('show') }}"
                        />

                        {{-- DOWNLOAD --}}
                        @can(Arcanesoft\Foundation\System\Policies\LogViewerPolicy::ability('download'))
                            <a href="{{ route('admin::system.log-viewer.logs.download', [$date]) }}"
                               class="btn btn-sm btn-light" data-toggle="tooltip" title="@lang('Download')">
                                <i class="fas fa-fw fa-download"></i>
                            </a>
                        @endcan

                        {{-- DELETE --}}
                        <x-arc:datatable-action
                            type="delete"
                            action="ARCANESOFT.emit('foundation::system.log-viewer.delete', {date: '{{ $date }}'})"
                            allowed="{{ Arcanesoft\Foundation\System\Policies\LogViewerPolicy::can('delete') }}"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">
                        <span class="badge badge-secondary">@lang('The list is empty!')</span>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </x-arc:card-table>
    </x-arc:card>

    {{-- DELETE MODAL/SCRIPT --}}
    @can(Arcanesoft\Foundation\System\Policies\LogViewerPolicy::ability('delete'))
        @push('modals')
            <x-arc:modal-action
                type="delete"
                action="{{ route('admin::system.log-viewer.logs.delete', [':date']) }}" method="DELETE"
                title="Delete Log File"
                body="Are you sure you want to delete this log file ?"
            />
        @endpush

        @push('scripts')
            <script defer>
                let deleteModal  = components.modal('div#delete-modal')
                let deleteForm   = components.form('form#delete-form')
                let deleteAction = deleteForm.getAction()

                ARCANESOFT.on('foundation::system.log-viewer.delete', ({date}) => {
                    deleteForm.setAction(deleteAction.replace(':date', date))
                    deleteModal.show()
                })

                deleteForm.onSubmit('DELETE', () => {
                    deleteModal.hide()
                    location.reload()
                })

                deleteModal.on('hidden', () => {
                    deleteForm.setAction(deleteAction);
                })
            </script>
        @endpush
    @endcan
</x-arc:layout>
