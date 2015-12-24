@section('header')
    <i class="fa fa-fw fa-book"></i> LogViewer
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-fw fa-list"></i> Log : {{ $log->date }}
            </h3>
            <div class="box-tools">
                <div class="btn-group">
                    <a href="{{ route('foundation::log-viewer.logs.download', [$log->date]) }}" class="btn btn-sm btn-success">
                        <i class="fa fa-fw fa-download"></i> DOWNLOAD
                    </a>
                    <a href="#delete-log-modal" class="btn btn-sm btn-danger" data-toggle="modal">
                        <i class="fa fa-fw fa-trash-o"></i> DELETE
                    </a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <td>File path :</td>
                            <td colspan="5">{{ $log->getPath() }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Log entries : </td>
                            <td>
                                <span class="label label-primary">{{ $entries->total() }}</span>
                            </td>
                            <td>Size :</td>
                            <td>
                                <span class="label label-primary">{{ $log->size() }}</span>
                            </td>
                            <td>Created at :</td>
                            <td>
                                <span class="label label-primary">{{ $log->createdAt() }}</span>
                            </td>
                            <td>Updated at :</td>
                            <td>
                                <span class="label label-primary">{{ $log->updatedAt() }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            @include('foundation::log-viewer._partials.menu')
        </div>
        <div class="col-sm-9">
            <ul class="timeline">
                @if ($presenter->hasPages())
                    <li class="time-label">
                        <span class="bg-aqua">
                            {{ trans('foundation::pagination.pages', ['current' => $entries->currentPage(), 'last' => $entries->lastPage()]) }}
                        </span>
                    </li>
                    <li>
                        <div class="timeline-item">
                            <div class="timeline-body text-center">
                                {!! $presenter->render() !!}
                            </div>
                        </div>
                    </li>
                @endif

                @foreach($entries as $key => $entry)
                    <li>
                        <div class="timeline-icon level-{{ $entry->level }}" data-toggle="tooltip" data-original-title="{{ $entry->name() }}">
                            {!! $entry->icon() !!}
                        </div>
                        <div class="timeline-item">
                            <span class="time">
                                <i class="fa fa-fw fa-clock-o"></i> {{ $entry->datetime->format('H:i:s') }}
                            </span>
                            <div class="timeline-header">
                                <span class="label level-env">
                                    ENV: {{ $entry->env }}
                                </span>
                            </div>
                            <div class="timeline-body">
                                <p>{{ $entry->header }}</p>
                                <button class="btn btn-xs btn-default" type="button" data-toggle="collapse" data-target="#log-entry-stack-{{  $key }}" aria-expanded="false" aria-controls="#log-entry-stack-{{  $key }}">
                                    Toggle stack
                                </button>
                                <div id="log-entry-stack-{{  $key }}" class="collapse">
                                    <pre>{{ $entry->stack }}</pre>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach

                @if ($presenter->hasPages())
                    <li>
                        <div class="timeline-item">
                            <div class="timeline-body text-center">
                                {!! $presenter->render() !!}
                            </div>
                        </div>
                    </li>
                @endif

                <li>
                    <div class="timeline-icon bg-gray">
                        <i class="fa fa-clock-o"></i>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    {{-- DELETE MODAL --}}
    <div id="delete-log-modal" class="modal fade">
        <div class="modal-dialog">
            {!! Form::open(['route' => 'foundation::log-viewer.logs.delete', 'method' => 'DELETE', 'id' => 'delete-log-form']) !!}
                {!! Form::hidden('date', $log->date) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">DELETE LOG FILE</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to <span class="label label-danger">DELETE</span> this log file <span class="label label-primary">{{ $log->date }}</span> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">DELETE FILE</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm  = $('form#delete-log-form'),
                submitBtn      = deleteLogForm.find('button[type="submit"]');

            deleteLogForm.submit(function(event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url:      $(this).attr('action'),
                    type:     $(this).attr('method'),
                    dataType: 'json',
                    data:     $(this).serialize(),
                    success: function(data) {
                        submitBtn.button('reset');
                        if (data.status === 'success') {
                            deleteLogModal.modal('hide');
                            location.replace("{{ route('foundation::log-viewer.logs.list') }}");
                        }
                        else {
                            alert('AJAX ERROR ! Check the console !');
                            console.error(data);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });
        });
    </script>
@endsection
