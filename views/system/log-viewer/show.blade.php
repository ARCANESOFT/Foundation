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
    <x-arc:card class="mb-4">
        <x-arc:card-header>{{ $log->date }}</x-arc:card-header>
        <x-arc:card-table>
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
        </x-arc:card-table>
        <x-arc:card-footer class="d-flex justify-content-between">
            @can(Arcanesoft\Foundation\System\Policies\LogViewerPolicy::ability('download'))
                <a href="{{ route('admin::system.log-viewer.logs.download', [$log->date]) }}" class="btn btn-sm btn-light">
                    <i class="fa fa-download"></i> @lang('Download')
                </a>
            @endcan

            @can(Arcanesoft\Foundation\System\Policies\LogViewerPolicy::ability('delete'))
                <button onclick="ARCANESOFT.emit('foundation::system.log-viewer.delete')" class="btn btn-sm btn-danger">
                    <i class="far fa-fw fa-trash-alt"></i> @lang('Delete')
                </button>
            @endcan
        </x-arc:card-footer>
    </x-arc:card>

    {{-- SEARCH FORM --}}
    <x-arc:card class="mb-4">
        <x-arc:card-body>
            <x-arc:form
                action="{{ route('admin::system.log-viewer.logs.search', [$log->date, $level]) }}"
                method="GET">
                <div class="input-group">
                    <input type="text" id="query" name="query" class="form-control"  value="{{ $query }}"
                           placeholder="@lang('Type here to search')" aria-label="@lang('Type here to search')"
                           aria-describedby="search-btn">
                    @unless (is_null($query))
                        <a href="{{ route('admin::system.log-viewer.logs.show', [$log->date]) }}" class="btn btn-secondary">
                            (@lang(':total results', ['total' => $entries->count()])) <i class="fa fa-fw fa-times"></i>
                        </a>
                    @endunless
                    <button type="button" id="search-btn" class="btn btn-primary" title="Search">
                        <span class="fa fa-fw fa-search"></span>
                    </button>
                </div>
            </x-arc:form>
        </x-arc:card-body>
    </x-arc:card>

    {{-- Log Levels Menu --}}
    <nav class="log-levels-menu-nav mb-4">
        @foreach($log->menu() as $levelKey => $item)
            @if ($item['count'] === 0)
                <a class="d-flex flex-row flex-lg-column align-items-baseline align-items-lg-center justify-content-between p-2 text-decoration-none rounded log-levels-menu-nav-item shadow-sm bg-white" disabled>
                    <span class="mb-1 text-uppercase text-muted {{ $level === $levelKey ? 'font-weight-bold' : ''}}">{{ $item['name'] }}</span>
                    <span class="text-muted">-</span>
                </a>
            @else
                <a href="{{ $item['url'] }}"
                   class="d-flex flex-row flex-lg-column align-items-baseline align-items-lg-center justify-content-between p-2 text-decoration-none rounded log-levels-menu-nav-item shadow-sm bg-white {{ $level === $levelKey ? 'active' : ''}}">
                    <span class="mb-1 text-uppercase text-dark {{ $level === $levelKey ? 'font-weight-bold' : ''}}">{{ $item['name'] }}</span>
                    <span class="badge bg-log-level-{{ $levelKey }} text-white">{{ $item['count'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>

    {{-- Log Entries --}}
    @if ($entries->hasPages())
        <div class="mb-4 text-right">
            <x-arc:pagination-pages :paginator="$entries"/>
        </div>
    @endif

    <section class="timeline-container">
        @foreach($entries as $key => $entry)
            <x-arc:card class="timeline-item mb-4">
                <div class="timeline-dot shadow-sm text-white bg-log-level-{{ $entry->level }}">{{ $entry->icon() }}</div>
                <x-arc:card-header class="d-flex align-items-center">
                    <div>
                        <span class="d-inline-block badge border border-dark text-dark mr-1">{{ $entry->datetime->format('H:i:s') }}</span>
                        <span class="d-inline-block badge border border-log-level-env text-dark mr-1">{{ $entry->env }}</span>
                        <span class="d-inline-block badge border border-log-level-{{ $entry->level }} text-dark">{{ $entry->name() }}</span>
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
                </x-arc:card-header>
                <x-arc:card-body>
                    <p class="small m-0">{{ $entry->header }}</p>

                    @if ($entry->hasStack())
                    <div id="log-entry-stack-{{ $key }}"
                         class="log-entry-stack-content font-monospace small collapse">{{ $entry->stack() }}</div>
                    @endif

                    @if ($entry->hasContext())
                    <div id="log-entry-context-{{ $key }}" class="log-entry-context-content small collapse">
                        <pre>{{ json_encode($entry->context(), JSON_PRETTY_PRINT) }}</pre>
                    </div>
                    @endif
                </x-arc:card-body>
            </x-arc:card>
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

            ARCANESOFT.on('foundation::system.log-viewer.delete', () => {
                deleteLogModal.show()
            });

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
        </script>
    @endpush
@endcan
