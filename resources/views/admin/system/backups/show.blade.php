@section('header')
    <h1><i class="fa fa-fw fa-database"></i> Backups <small>Monitor Status</small></h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">Backups</h2>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-condensed no-margin">
                            <tr>
                                <th>Name :</th>
                                <td>
                                    <span class="label label-inverse">{{ $status->backupName() }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Disk :</th>
                                <td>
                                    <span class="label label-primary">{{ $status->diskName() }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Reachable :</th>
                                <td>
                                    @if ($status->isReachable())
                                        <span class="label label-success">Yes</span>
                                    @else
                                        <span class="label label-danger">No</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Healthy :</th>
                                <td>
                                    @if ($status->isHealthy())
                                        <span class="label label-success">Yes</span>
                                    @else
                                        <span class="label label-danger">No</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th># of backups :</th>
                                <td>
                                    @if ($status->isReachable())
                                        <span class="label label-{{ ($amount = $status->amountOfBackups()) ? 'info' : 'default' }}">
                                            {{ $amount }}
                                        </span>
                                    @else
                                        <span class="label label-default">/</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Newest backup :</th>
                                <td>
                                    @if ($status->isReachable())
                                        <small>{{ $status->dateOfNewestBackup() ?: 'No backups present' }}</small>
                                    @else
                                        <span class="label label-default">/</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Used storage :</th>
                                <td>
                                    @if ($status->isReachable())
                                        <span class="label label-default">{{ $status->humanReadableUsedStorage() }}</span>
                                    @else
                                        <span class="label label-default">/</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">Backups</h2>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-condensed no-margin">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Path</th>
                                    <th>Size</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($backups as $backup)
                                <tr>
                                    <td>
                                        <small>{{ $backup->date() }}</small>
                                    </td>
                                    <td>
                                        <span class="label label-inverse">{{ $backup->path() }}</span>
                                    </td>
                                    <td>
                                        <span class="label label-default">
                                            {{ Spatie\Backup\Helpers\Format::humanReadableSize($backup->size()) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
