@section('header')
    <h1><i class="fa fa-fw fa-database"></i> Backups <small>Monitor statuses</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h2 class="box-title">Statuses</h2>
            <div class="box-tools">
                <a href="#runBackupsModal" class="btn btn-xs btn-success">
                    <i class="fa fa-fw fa-floppy-o"></i> Run Backups
                </a>
                <a href="#clearBackupsModal" class="btn btn-xs btn-warning">
                    <i class="fa fa-fw fa-trash-o"></i> Clear Backups
                </a>
            </div>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed table-hover no-margin">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Disk</th>
                            <th class="text-center">Reachable</th>
                            <th class="text-center">Healthy</th>
                            <th class="text-center"># of backups</th>
                            <th class="text-center">Newest backup</th>
                            <th class="text-center">Used storage</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statuses as $index => $status)
                        <tr>
                            <td>
                                <span class="label label-inverse">{{ $status->backupName() }}</span>
                            </td>
                            <td>
                                <span class="label label-primary">{{ $status->diskName() }}</span>
                            </td>
                            <td class="text-center">
                                @if ($status->isReachable())
                                    <span class="label label-success">Yes</span>
                                @else
                                    <span class="label label-danger">No</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($status->isHealthy())
                                    <span class="label label-success">Yes</span>
                                @else
                                    <span class="label label-danger">No</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($status->isReachable())
                                    <span class="label label-{{ ($amount = $status->amountOfBackups()) ? 'info' : 'default' }}">
                                            {{ $amount }}
                                        </span>
                                @else
                                    <span class="label label-default">/</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($status->isReachable())
                                    <small>{{ $status->dateOfNewestBackup() ?: 'No backups present' }}</small>
                                @else
                                    <span class="label label-default">/</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($status->isReachable())
                                    <span class="label label-default">{{ $status->humanReadableUsedStorage() }}</span>
                                @else
                                    <span class="label label-default">/</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{ route('admin::foundation.system.backups.show', [$index]) }}" class="btn btn-xs btn-info" data-toggle="tooltip" data-original-title="Show">
                                    <i class="fa fa-search"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <div id="runBackupsModal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => 'admin::foundation.system.backups.backup', 'method' => 'POST', 'id' => 'runBackupsForm', 'class' => '', 'autocomplete' => 'off']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Backup all</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to run the <span class="label label-success">backups</span> ?</p>
                    </div>
                    <div class="modal-footer">
                        {{ Form::button('Cancel', ['data-dismiss' => 'modal', 'class' => 'btn btn-sm btn-default pull-left']) }}
                        {{ Form::button('Backup', ['type' => 'submit', 'class' => 'btn btn-sm btn-success', 'data-loading-text' => 'Loading&hellip;']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>

    <div id="clearBackupsModal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => 'admin::foundation.system.backups.clear', 'method' => 'POST', 'id' => 'clearBackupsForm', 'class' => '', 'autocomplete' => 'off']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Clear all backups</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to <span class="label label-warning">clear</span> all the backups ?</p>
                    </div>
                    <div class="modal-footer">
                        {{ Form::button('Cancel', ['data-dismiss' => 'modal', 'class' => 'btn btn-sm btn-default pull-left']) }}
                        {{ Form::button('Clear', ['type' => 'submit', 'class' => 'btn btn-sm btn-warning', 'data-loading-text' => 'Loading&hellip;']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            // RUN BACKUPS MODAL
            //--------------------------------
            var $runBackupsModal = $('div#runBackupsModal'),
                $runBackupsForm  = $('form#runBackupsForm');

            $('a[href="#runBackupsModal"]').on('click', function (e) {
                e.preventDefault();

                $runBackupsModal.modal('show');
            });

            $runBackupsForm.on('submit', function (e) {
                e.preventDefault();

                var $submitBtn = $runBackupsForm.find('button[type="submit"]');
                $submitBtn.button('loading');

                $.ajax({
                    url:      $runBackupsForm.attr('action'),
                    type:     $runBackupsForm.attr('method'),
                    dataType: 'json',
                    data:     $runBackupsForm.serialize(),
                    success: function (data) {
                        if (data.status === 'success') {
                            $runBackupsModal.modal('hide');
                            location.reload();
                        }
                        else {
                            alert('ERROR ! Check the console !');
                            console.error(data.message);
                            $submitBtn.button('reset');
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        $submitBtn.button('reset');
                    }
                });
            });

            // CLEAR BACKUPS MODAL
            //--------------------------------
            var $clearBackupsModal = $('div#clearBackupsModal'),
                $clearBackupsForm  = $('form#clearBackupsForm');

            $('a[href="#clearBackupsModal"]').on('click', function (e) {
                e.preventDefault();

                $clearBackupsModal.modal('show');
            });

            $clearBackupsForm.on('submit', function (e) {
                e.preventDefault();

                var $submitBtn = $clearBackupsForm.find('button[type="submit"]');
                $submitBtn.button('loading');

                $.ajax({
                    url:      $clearBackupsForm.attr('action'),
                    type:     $clearBackupsForm.attr('method'),
                    dataType: 'json',
                    data:     $clearBackupsForm.serialize(),
                    success: function (data) {
                        if (data.status === 'success') {
                            $clearBackupsModal.modal('hide');
                            location.reload();
                        }
                        else {
                            alert('ERROR ! Check the console !');
                            console.error(data.message);
                            $submitBtn.button('reset');
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        $submitBtn.button('reset');
                    }
                });
            });
        });
    </script>
@endsection
