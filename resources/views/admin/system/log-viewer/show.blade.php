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
                        <td><b>{{ trans('foundation::log-viewer.attributes.file_path') }} :</b></td>
                        <td colspan="3">{{ $log->getPath() }}</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><b>{{ trans('foundation::log-viewer.attributes.log_entries') }} :</b></td>
                        <td>
                            <span class="label label-{{ $entries->total() ? 'info' : 'default'}}">
                                {{ $entries->total() }}
                            </span>
                        </td>
                        <td><b>{{ trans('foundation::log-viewer.attributes.size') }} :</b></td>
                        <td>
                            <span class="label label-inverse">{{ $log->size() }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><b>{{ trans('core::generals.created_at') }} :</b></td>
                        <td>
                            <small>{{ $log->createdAt() }}</small>
                        </td>
                        <td><b>{{ trans('core::generals.updated_at') }} :</b></td>
                        <td>
                            <small>{{ $log->updatedAt() }}</small>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer text-right">
            @can(Arcanesoft\Foundation\Policies\LogViewerPolicy::PERMISSION_DOWNLOAD)
                {{ ui_link('download', route('admin::foundation.system.log-viewer.logs.download', [$log->date])) }}
            @endcan

            @can(Arcanesoft\Foundation\Policies\LogViewerPolicy::PERMISSION_DELETE)
                {{ ui_link('delete', '#delete-log-modal') }}
            @endcan
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
    <div id="delete-log-modal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => ['admin::foundation.system.log-viewer.logs.delete', $log->date], 'method' => 'DELETE', 'id' => 'delete-log-form', 'autocomplete' => 'off']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">{{ trans("foundation::log-viewer.modals.delete.title") }}</h4>
                    </div>
                    <div class="modal-body">
                        <p>{!! trans("foundation::log-viewer.modals.delete.message", ['date' => $log->date]) !!}</p>
                    </div>
                    <div class="modal-footer">
                        {{ ui_button('cancel')->appendClass('pull-left')->setAttribute('data-dismiss', 'modal') }}
                        {{ ui_button('delete', 'submit')->withLoadingText() }}
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

            $('a[href="#delete-log-modal"]').on('click', function (event) {
                event.preventDefault();

                $deleteLogModal.modal('show');
            });

            $deleteLogForm.on('submit', function(event) {
                event.preventDefault();

                var $submitBtn = $deleteLogForm.find('button[type="submit"]');
                    $submitBtn.button('loading');

                axios.delete($deleteLogForm.attr('action'), {data: $deleteLogForm.serialize()})
                     .then(function (response) {
                         if (response.data.code === 'success') {
                             $deleteLogModal.modal('hide');
                             location.replace("{{ route('admin::foundation.system.log-viewer.logs.list') }}");
                         }
                         else {
                             alert('AJAX ERROR ! Check the console !');
                             $submitBtn.button('reset');
                         }
                     })
                     .catch(function (error) {
                         alert('AJAX ERROR ! Check the console !');
                         console.log(error);
                         $submitBtn.button('reset');
                     });

                return false;
            });
        });
    </script>
@endsection
