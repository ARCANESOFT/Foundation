@section('header')
    <i class="fa fa-fw fa-book"></i> LogViewer
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-fw fa-list"></i> Log : {{ $log->date }}
            </h3>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed no-margin">
                    <thead>
                    <tr>
                        <td><b>File path :</b></td>
                        <td colspan="3">{{ $log->getPath() }}</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><b>Log entries :</b></td>
                        <td>
                            <span class="label label-{{ $entries->total() ? 'info' : 'default'}}">
                                {{ $entries->total() }}
                            </span>
                        </td>
                        <td><b>Size :</b></td>
                        <td>
                            <span class="label label-inverse">{{ $log->size() }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Created at :</b></td>
                        <td>
                            <small>{{ $log->createdAt() }}</small>
                        </td>
                        <td><b>Updated at :</b></td>
                        <td>
                            <small>{{ $log->updatedAt() }}</small>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer text-right">
            <a href="{{ route('admin::foundation.system.log-viewer.logs.download', [$log->date]) }}" class="btn btn-sm btn-success">
                <i class="fa fa-fw fa-download"></i> DOWNLOAD
            </a>
            <a href="#deleteLogModal" data-toggle="modal" class="btn btn-sm btn-danger">
                <i class="fa fa-fw fa-trash-o"></i> DELETE
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            @include('foundation::admin.system.log-viewer._includes.menu')
        </div>
        <div class="col-md-9">
            @include('foundation::admin.system.log-viewer._includes.timeline-entries', compact('entries'))
        </div>
    </div>
@endsection

@section('modals')
    <div id="deleteLogModal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => 'admin::foundation.system.log-viewer.logs.delete', 'method' => 'DELETE', 'id' => 'deleteLogForm', 'autocomplete' => 'off']) }}
                {{ Form::hidden('date', $log->date) }}
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
                        {{ Form::button('Cancel', ['data-dismiss' => 'modal', 'class' => 'btn btn-sm btn-default pull-left']) }}
                        <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">DELETE FILE</button>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            var $deleteLogModal = $('div#deleteLogModal'),
                $deleteLogForm  = $('form#deleteLogForm');

            $deleteLogForm.on('submit', function(event) {
                event.preventDefault();

                var $submitBtn = $deleteLogForm.find('button[type="submit"]');
                    $submitBtn.button('loading');

                $.ajax({
                    url:      $deleteLogForm.attr('action'),
                    type:     $deleteLogForm.attr('method'),
                    dataType: 'json',
                    data:     $deleteLogForm.serialize(),
                    success: function(data) {
                        if (data.status === 'success') {
                            $deleteLogModal.modal('hide');
                            location.replace("{{ route('admin::foundation.system.log-viewer.logs.list') }}");
                        }
                        else {
                            alert('AJAX ERROR ! Check the console !');
                            $submitBtn.button('reset');
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        $submitBtn.button('reset');
                    }
                });

                return false;
            });
        });
    </script>
@endsection
