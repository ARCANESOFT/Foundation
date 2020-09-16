@extends(arcanesoft\foundation()->template())

<?php
/**
 * @var  Arcanedev\LogViewer\Entities\Log                                                    $log
 * @var  Arcanedev\LogViewer\Entities\LogEntry[]|Illuminate\Pagination\LengthAwarePaginator  $entries
 */
?>

@section('page-title')
    <i class="fas fa-fw fa-clipboard-list"></i> @lang('LogViewer')
@endsection

@section('content')
    {{-- Log Details --}}
    <div class="card card-borderless shadow-sm mb-4">
        <div class="card-header d-flex align-items-center justify-content-between px-2">
            <span class="badge badge-outline-secondary">{{ $log->date }}</span>
            <div>
                @can(Arcanesoft\Foundation\System\Policies\LogViewerPolicy::ability('download'))
                    <a href="{{ route('admin::system.log-viewer.logs.download', [$log->date]) }}" class="btn btn-sm btn-light">
                        <i class="fa fa-download"></i> @lang('Download')
                    </a>
                @endcan

                @can(Arcanesoft\Foundation\System\Policies\LogViewerPolicy::ability('delete'))
                    <button onclick="Foundation.$emit('foundation::system.log-viewer.delete')" class="btn btn-sm btn-danger">
                        <i class="far fa-fw fa-trash-alt"></i> @lang('Delete')
                    </button>
                @endcan
            </div>
        </div>
        <table class="table table-borderless mb-0">
            <tbody>
                <tr>
                    <th class="font-weight-light text-uppercase text-muted">@lang('Path')</th>
                    <td class="font-monospace small">{{ $log->getPath() }}</td>
                </tr>
                <tr>
                    <th class="font-weight-light text-uppercase text-muted">@lang('Size')</th>
                    <td class="small">{{ $log->size() }}</td>
                </tr>
                <tr>
                    <th class="font-weight-light text-uppercase text-muted">@lang('Created at')</th>
                    <td class="small">{{ $log->createdAt() }}</td>
                </tr>
                <tr>
                    <th class="font-weight-light text-uppercase text-muted">@lang('Updated at')</th>
                    <td class="small">{{ $log->updatedAt() }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- SEARCH FORM --}}
    <div class="card card-borderless shadow-sm mb-4">
        <div class="card-body p-2">
            <form action="{{ route('admin::system.log-viewer.logs.search', [$log->date, $level]) }}" method="GET">
                <div class="input-group">
                    <input type="text" id="query" name="query" class="form-control"  value="{{ $query }}"
                           placeholder="@lang('Type here to search')" aria-label="@lang('Type here to search')" aria-describedby="search-btn">
                    @unless (is_null($query))
                        <a href="{{ route('admin::system.log-viewer.logs.show', [$log->date]) }}" class="btn btn-secondary">
                            (@lang(':total results', ['total' => $entries->count()])) <i class="fa fa-fw fa-times"></i>
                        </a>
                    @endunless
                    <button type="button" id="search-btn" class="btn btn-primary">
                        <span class="fa fa-fw fa-search"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Log Levels Menu --}}
    <nav class="log-levels-menu-nav mb-4">
        @foreach($log->menu() as $levelKey => $item)
            @if ($item['count'] === 0)
                <a href="#" class="log-levels-menu-nav-item shadow-sm bg-log-level-empty disabled {{ $level === $levelKey ? 'active' : ''}}">
                    <span class="level-name text-muted mb-1">{{ $item['name'] }}</span>
                    <span class="badge badge-light text-muted">-</span>
                </a>
            @else
                <a href="{{ $item['url'] }}" class="log-levels-menu-nav-item shadow-sm bg-log-level-{{ $levelKey }} {{ $level === $levelKey ? 'active' : ''}}">
                    <span class="level-name mb-1">{{ $item['name'] }}</span>
                    <span class="badge badge-light">{{ $item['count'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>

    {{-- Log Entries --}}
    <div class="mb-4">
        @if ($entries->hasPages())
            <span class="badge badge-info">
                @lang('Page :current of :last', ['current' => $entries->currentPage(), 'last' => $entries->lastPage()])
            </span>
        @endif
    </div>

    <section class="timeline-container">
        @foreach($entries as $key => $entry)
            <div class="timeline-item card card-borderless shadow-sm mb-4">
                <div class="timeline-dot shadow-sm text-white bg-log-level-{{ $entry->level }}">{{ $entry->icon() }}</div>
                <div class="card-header d-flex px-3 py-2">
                    <div>
                        <span class="badge badge-outline-dark">{{ $entry->datetime->format('H:i:s') }}</span>
                        <span class="badge badge-log-level-outline-env">{{ $entry->env }}</span>
                        <span class="badge badge-log-level-outline-{{ $entry->level }}">{{ $entry->name() }}</span>
                    </div>

                    @if ($entry->hasStack())
                        <a class="btn btn-sm btn-light ml-auto" role="button" data-toggle="collapse"
                           href="#log-entry-stack-{{ $key }}" aria-expanded="false" aria-controls="log-stack-{{ $key }}">
                            <i class="fa fa-toggle-on"></i> @lang('Stack')
                        </a>
                    @endif

                    @if ($entry->hasContext())
                        <a class="btn btn-sm btn-light ml-auto" role="button" data-toggle="collapse"
                           href="#log-entry-context-{{ $key }}" aria-expanded="false" aria-controls="log-context-{{ $key }}">
                            <i class="fa fa-toggle-on"></i> @lang('Context')
                        </a>
                    @endif
                </div>
                <div class="card-body p-3">
                    {{ $entry->header }}

                    @if ($entry->hasStack())
                    <div id="log-entry-stack-{{ $key }}" class="log-entry-stack-content small collapse">
                        {{ $entry->stack() }}
                    </div>
                    @endif

                    @if ($entry->hasContext())
                    <div id="log-entry-context-{{ $key }}" class="log-entry-context-content small collapse">
                        <pre>{{ json_encode($entry->context(), JSON_PRETTY_PRINT) }}</pre>
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
    </section>

    {{ $entries->appends(compact('query'))->render('foundation::_components.pagination', ['class' => 'justify-content-center mb-0']) }}
@endsection

{{-- DELETE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\System\Policies\LogViewerPolicy::ability('delete'))
    @push('modals')
        <div class="modal fade" id="delete-log-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="deleteLogTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('admin::system.log-viewer.logs.delete', [$log->date]) }}" id="delete-log-form">
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
                            {{ arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                            {{ arcanesoft\ui\action_button('delete')->submit() }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            let deleteLogModal = twbs.Modal.make('div#delete-log-modal')
            let deleteLogForm  = Form.make('form#delete-log-form')

            Foundation.$on('foundation::system.log-viewer.delete', () => {
                deleteLogModal.show()
            });

            deleteLogForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = Foundation.ui.loadingButton(
                    deleteLogForm.elt().querySelector('button[type="submit"]')
                )
                submitBtn.loading()

                request()
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
        </script>
    @endpush
@endcan
