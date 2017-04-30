@section('header')
    <h1><i class="fa fa-fw fa-database"></i> {{ trans('foundation::backups.titles.backups') }} <small>{{ trans('foundation::backups.titles.monitor-statuses-list') }}</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h2 class="box-title">{{ trans('foundation::backups.titles.monitor-statuses-list') }}</h2>
            <div class="box-tools">
                @can(Arcanesoft\Foundation\Policies\BackupPolicy::PERMISSION_CREATE)
                    <a href="#run-backups-modal" class="btn btn-xs btn-success">
                        <i class="fa fa-fw fa-floppy-o"></i> {{ trans('foundation::backups.actions.run-backups') }}
                    </a>
                @endcan

                @can(Arcanesoft\Foundation\Policies\BackupPolicy::PERMISSION_DELETE)
                    <a href="#clear-backups-modal" class="btn btn-xs btn-warning">
                        <i class="fa fa-fw fa-eraser"></i> {{ trans('foundation::backups.actions.clear-backups') }}
                    </a>
                @endcan
            </div>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed table-hover no-margin">
                    <thead>
                        <tr>
                            <th>{{ trans('foundation::backups.attributes.name') }}</th>
                            <th>{{ trans('foundation::backups.attributes.disk') }}</th>
                            <th class="text-center">{{ trans('foundation::backups.attributes.reachable') }}</th>
                            <th class="text-center">{{ trans('foundation::backups.attributes.healthy') }}</th>
                            <th class="text-center">{{ trans('foundation::backups.attributes.number_of_backups') }}</th>
                            <th class="text-center">{{ trans('foundation::backups.attributes.newest_backup') }}</th>
                            <th class="text-center">{{ trans('foundation::backups.attributes.used_storage') }}</th>
                            <th class="text-right">{{ trans('core::generals.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($statuses as $index => $status)
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
                                        {{ label_count($status->amountOfBackups()) }}
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
                                    {{ ui_link_icon('show', route('admin::foundation.system.backups.show', [$index])) }}
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    @can(Arcanesoft\Foundation\Policies\BackupPolicy::PERMISSION_CREATE)
        <div id="run-backups-modal" class="modal fade">
            <div class="modal-dialog">
                {{ Form::open(['route' => 'admin::foundation.system.backups.backup', 'method' => 'POST', 'id' => 'run-backups-form', 'class' => '', 'autocomplete' => 'off']) }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">{{ trans('foundation::backups.modals.backup.title') }}</h4>
                        </div>
                        <div class="modal-body">
                            <p>{!! trans('foundation::backups.modals.backup.message') !!}</p>
                        </div>
                        <div class="modal-footer">
                            {{ ui_button('cancel')->appendClass('pull-left')->setAttribute('data-dismiss', 'modal') }}
                            {{ ui_button('backup', 'submit')->withLoadingText() }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    @endcan

    @can(Arcanesoft\Foundation\Policies\BackupPolicy::PERMISSION_DELETE)
        <div id="clear-backups-modal" class="modal fade">
            <div class="modal-dialog">
                {{ Form::open(['route' => 'admin::foundation.system.backups.clear', 'method' => 'POST', 'id' => 'clear-backups-form', 'class' => '', 'autocomplete' => 'off']) }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">{{ trans('foundation::backups.modals.clear.title') }}</h4>
                        </div>
                        <div class="modal-body">
                            <p>{!! trans('foundation::backups.modals.clear.message') !!}</p>
                        </div>
                        <div class="modal-footer">
                            {{ ui_button('cancel')->appendClass('pull-left')->setAttribute('data-dismiss', 'modal') }}
                            {{ ui_button('clear', 'submit')->withLoadingText() }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    @endcan
@endsection

@section('scripts')
    {{-- RUN BACKUPS MODAL --}}
    @can(Arcanesoft\Foundation\Policies\BackupPolicy::PERMISSION_CREATE)
        <script>
            $(function () {
                var $runBackupsModal = $('div#run-backups-modal'),
                    $runBackupsForm  = $('form#run-backups-form');

                $('a[href="#run-backups-modal"]').on('click', function (e) {
                    e.preventDefault();

                    $runBackupsModal.modal('show');
                });

                $runBackupsForm.on('submit', function (e) {
                    e.preventDefault();

                    var $submitBtn = $runBackupsForm.find('button[type="submit"]');
                        $submitBtn.button('loading');

                    axios.post($runBackupsForm.attr('action'))
                         .then(function (response) {
                             if (response.data.code === 'success') {
                                 $runBackupsModal.modal('hide');
                                 location.reload();
                             }
                             else {
                                 alert('ERROR ! Check the console !');
                                 console.error(response.data.message);
                                 $submitBtn.button('reset');
                             }
                         })
                         .catch(function (error) {
                             alert('AJAX ERROR ! Check the console !');
                             console.log(error);
                             $submitBtn.button('reset');
                         });
                });
            });
        </script>
    @endcan

    {{-- CLEAR BACKUPS MODAL --}}
    @can(Arcanesoft\Foundation\Policies\BackupPolicy::PERMISSION_DELETE)
        <script>
            $(function () {
                var $clearBackupsModal = $('div#clear-backups-modal'),
                    $clearBackupsForm  = $('form#clear-backups-form');

                $('a[href="#clear-backups-modal"]').on('click', function (e) {
                    e.preventDefault();

                    $clearBackupsModal.modal('show');
                });

                $clearBackupsForm.on('submit', function (e) {
                    e.preventDefault();

                    var $submitBtn = $clearBackupsForm.find('button[type="submit"]');
                    $submitBtn.button('loading');

                    axios.post($clearBackupsForm.attr('action'))
                        .then(function (response) {
                            if (response.data.code === 'success') {
                                $clearBackupsModal.modal('hide');
                                location.reload();
                            }
                            else {
                                alert('ERROR ! Check the console !');
                                console.error(response.data.message);
                                $submitBtn.button('reset');
                            }
                        })
                        .catch(function (error) {
                            alert('AJAX ERROR ! Check the console !');
                            console.log(error);
                            $submitBtn.button('reset');
                        });
                });
            });
        </script>
    @endcan
@endsection
