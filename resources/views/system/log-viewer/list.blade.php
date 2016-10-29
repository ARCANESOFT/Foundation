@section('header')
    <i class="fa fa-fw fa-book"></i> LogViewer
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-fw fa-list"></i> Logs List</h3>
            <div class="box-tools">
                <div class="btn-group">
                    <a href="{{ route('foundation::system.log-viewer.index') }}" class="btn btn-sm btn-default {{ route_is('foundation::system.log-viewer.index') ? 'active' : '' }}">
                        <i class="fa fa-fw fa-dashboard"></i> Dashboard
                    </a>
                    <a href="{{ route('foundation::system.log-viewer.logs.list') }}" class="btn btn-sm btn-default {{ route_is('foundation::system.log-viewer.logs.list') ? 'active' : '' }}">
                        <i class="fa fa-fw fa-list"></i> Logs list
                    </a>
                </div>
            </div>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed table-hover table-stats no-margin">
                    <thead>
                        <tr>
                            @foreach($headers as $key => $header)
                            <th class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                                @if ($key == 'date')
                                    <span class="label label-info">{{ $header }}</span>
                                @else
                                    <span class="label level-{{ $key }}">
                                        {!! log_styler()->icon($key) . ' ' . $header !!}
                                    </span>
                                @endif
                            </th>
                            @endforeach
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($rows->count())
                            @foreach($rows as $date => $row)
                            <tr>
                                @foreach($row as $key => $value)
                                    <td class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                                        @if ($key == 'date')
                                            <span class="label label-primary">{{ $value }}</span>
                                        @else
                                            <span class="label level-{{ $value !== 0 ? $key : 'empty' }}">
                                                {{ $value }}
                                            </span>
                                        @endif
                                    </td>
                                @endforeach
                                <td class="text-right">
                                    <a href="{{ route('foundation::system.log-viewer.logs.show', [$date]) }}" class="btn btn-xs btn-info" data-toggle="tooltip" data-original-title="Show">
                                        <i class="fa fa-search"></i>
                                    </a>
                                    <a href="{{ route('foundation::system.log-viewer.logs.download', [$date]) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-original-title="Download">
                                        <i class="fa fa-download"></i>
                                    </a>
                                    <a href="#delete-log-modal" class="btn btn-xs btn-danger" data-log-date="{{ $date }}" data-toggle="tooltip" data-original-title="Delete">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="text-center">
                                    <span class="label label-default">
                                        There is no log for the time being.
                                    </span>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if ($rows->hasPages())
            <div class="box-footer">
                {!! $rows->render() !!}
            </div>
        @endif
    </div>
@endsection

@section('modals')
    <div id="delete-log-modal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => 'foundation::system.log-viewer.logs.delete', 'method' => 'DELETE', 'id' => 'delete-log-form', 'autocomplete' => 'off']) }}
                {{ Form::hidden('date') }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">DELETE LOG FILE</h4>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        {{ Form::button('Cancel', ['data-dismiss' => 'modal', 'class' => 'btn btn-sm btn-default pull-left']) }}
                        <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">
                            DELETE FILE
                        </button>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            var $deleteLogModal = $('div#delete-log-modal'),
                $deleteLogForm  = $('form#delete-log-form');

            $('a[href="#delete-log-modal"]').on('click', function(event) {
                event.preventDefault();
                var date = $(this).data('log-date');
                $deleteLogForm.find('input[name="date"]').val(date);
                $deleteLogModal.find('.modal-body p').html(
                    'Are you sure you want to <span class="label label-danger">DELETE</span> this log file <span class="label label-primary">' + date + '</span> ?'
                );

                $deleteLogModal.modal('show');
            });

            $deleteLogForm.on('submit', function(event) {
                event.preventDefault();
                var submitBtn = $deleteLogForm.find('button[type="submit"]');

                submitBtn.button('loading');

                $.ajax({
                    url:      $deleteLogForm.attr('action'),
                    type:     $deleteLogForm.attr('method'),
                    dataType: 'json',
                    data:     $deleteLogForm.serialize(),
                    success: function(data) {
                        if (data.status === 'success') {
                            $deleteLogModal.modal('hide');
                            location.reload();
                        }
                        else {
                            alert('AJAX ERROR ! Check the console !');
                            submitBtn.button('reset');
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

            $deleteLogModal.on('hidden.bs.modal', function() {
                $deleteLogForm.find('input[name=date]').val('');
                $deleteLogModal.find('.modal-body p').html('');
            });
        });
    </script>
@endsection
