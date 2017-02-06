@section('header')
    <h1><i class="fa fa-fw fa-database"></i> Backups <small>Monitor statuses</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h2 class="box-title">Statuses</h2>
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

@section('scripts')
@endsection
