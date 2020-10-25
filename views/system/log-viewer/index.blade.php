@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-clipboard-list"></i> @lang('LogViewer')
@endsection

@section('content')
    <x-arc:card>
        <x-arc:card-header>@lang('Logs')</x-arc:card-header>
        <x-arc:card-table>
            <thead>
                <tr>
                    @foreach($headers as $key => $header)
                    <th scope="col" class="font-weight-light text-uppercase text-muted {{ $key === 'date' ? 'text-left' : 'text-center' }}">
                        {{ $header }}
                    </th>
                    @endforeach
                    <th scope="col" class="font-weight-light text-uppercase text-muted text-right">@lang('Actions')</th>
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
                    <td class="text-right">
                        @can(Arcanesoft\Foundation\System\Policies\LogViewerPolicy::ability('show'))
                            <a href="{{ route('admin::system.log-viewer.logs.show', [$date]) }}"
                               class="btn btn-sm btn-light" data-toggle="tooltip" title="@lang('Show')">
                                <i class="far fa-fw fa-eye"></i>
                            </a>
                        @endcan

                        @can(Arcanesoft\Foundation\System\Policies\LogViewerPolicy::ability('download'))
                            <a href="{{ route('admin::system.log-viewer.logs.download', [$date]) }}"
                               class="btn btn-sm btn-light" data-toggle="tooltip" title="@lang('Download')">
                                <i class="fas fa-fw fa-download"></i>
                            </a>
                        @endcan

                        @can(Arcanesoft\Foundation\System\Policies\LogViewerPolicy::ability('delete'))
                            <button onclick="ARCANESOFT.emit('foundation::system.log-viewer.delete', {date: '{{ $date }}'})"
                                    class="btn btn-sm btn-light text-danger" data-toggle="tooltip" title="@lang('Delete')">
                                <i class="far fa-fw fa-trash-alt"></i>
                            </button>
                        @endcan
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
@endsection

{{-- DELETE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\System\Policies\LogViewerPolicy::ability('delete'))
    @push('modals')
        <div class="modal fade" id="delete-log-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="deleteLogTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('admin::system.log-viewer.logs.delete', [':id']) }}" id="delete-log-form">
                    @csrf
                    @method('DELETE')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="deleteLogTitle">@lang('Delete Log')</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @lang('Are you sure you want to delete this log ?')
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button data-dismiss="modal" class="btn btn-light">@lang('Cancel')</button>
                            <button type="submit" class="btn btn-danger">@lang('Delete')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endpush

    @push('scripts')
        <script defer>
            let deleteLogModal  = twbs.Modal.make('div#delete-log-modal')
            let deleteLogForm   = Form.make('form#delete-log-form')
            let deleteLogAction = deleteLogForm.getAction()

            ARCANESOFT.on('foundation::system.log-viewer.delete', ({date}) => {
                deleteLogForm.setAction(deleteLogAction.replace(':id', date))
                deleteLogModal.show()
            })

            deleteLogForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = ARCANESOFT.ui.loadingButton(
                    deleteLogForm.elt().querySelector('button[type="submit"]')
                )
                submitBtn.loading()

                ARCANESOFT
                    .request()
                    .delete(deleteLogForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            deleteLogModal.hide()
                            location.replace("{{ route('admin::system.log-viewer.index') }}")
                        }
                        else {
                            alert('ERROR ! Check the console !')
                            submitBtn.reset()
                        }
                    })
                    .catch((error) => {
                        alert('AJAX ERROR ! Check the console !')
                        console.log(error)
                        submitBtn.reset()
                    })
            })

            deleteLogModal.on('hidden', () => {
                deleteLogForm.setAction(deleteLogAction);
            })
        </script>
    @endpush
@endcan

