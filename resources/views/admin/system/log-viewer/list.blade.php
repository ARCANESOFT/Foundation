@section('header')
    <i class="fa fa-fw fa-book"></i> LogViewer
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-fw fa-list"></i> {{ trans('foundation::log-viewer.titles.logs-list') }}</h3>
            <div class="box-tools">
                <div class="btn-group">
                    <a href="{{ route('admin::foundation.system.log-viewer.index') }}" class="btn btn-xs btn-default {{ route_is('admin::foundation.system.log-viewer.index') ? 'active' : '' }}">
                        <i class="fa fa-fw fa-dashboard"></i> {{ trans('foundation::log-viewer.titles.dashboard') }}
                    </a>
                    <a href="{{ route('admin::foundation.system.log-viewer.logs.list') }}" class="btn btn-xs btn-default {{ route_is('admin::foundation.system.log-viewer.logs.list') ? 'active' : '' }}">
                        <i class="fa fa-fw fa-list"></i> {{ trans('foundation::log-viewer.titles.logs-list') }}
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
                                        {!! log_styler()->icon($key).' '.$header !!}
                                    </span>
                                @endif
                            </th>
                            @endforeach
                            <th class="text-right">{{ trans('core::generals.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rows as $date => $row)
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
                                    @can(Arcanesoft\Foundation\Policies\LogViewerPolicy::PERMISSION_SHOW)
                                        {{ ui_link_icon('show', route('admin::foundation.system.log-viewer.logs.show', [$date])) }}
                                    @endcan

                                    @can(Arcanesoft\Foundation\Policies\LogViewerPolicy::PERMISSION_DOWNLOAD)
                                        {{ ui_link_icon('download', route('admin::foundation.system.log-viewer.logs.download', [$date])) }}
                                    @endcan

                                    @can(Arcanesoft\Foundation\Policies\LogViewerPolicy::PERMISSION_DELETE)
                                        {{ ui_link_icon('delete', '#delete-log-modal', ['data-log-date' => $date]) }}
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">
                                    <span class="label label-default">{{ trans('foundation::log-viewer.no-entries') }}</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($rows->hasPages())
            <div class="box-footer">{!! $rows->render() !!}</div>
        @endif
    </div>
@endsection

@section('modals')
    @can(\Arcanesoft\Foundation\Policies\LogViewerPolicy::PERMISSION_DELETE)
        <div id="delete-log-modal" class="modal fade">
            <div class="modal-dialog">
                {{ Form::open(['route' => ['admin::foundation.system.log-viewer.logs.delete', ':date'], 'method' => 'DELETE', 'id' => 'delete-log-form', 'autocomplete' => 'off']) }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">{{ trans("foundation::log-viewer.modals.delete.title") }}</h4>
                        </div>
                        <div class="modal-body">
                            <p></p>
                        </div>
                        <div class="modal-footer">
                            {{ ui_button('cancel')->appendClass('pull-left')->setAttribute('data-dismiss', 'modal') }}
                            {{ ui_button('delete', 'submit')->withLoadingText() }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    @endcan
@endsection

@section('scripts')
    @can(\Arcanesoft\Foundation\Policies\LogViewerPolicy::PERMISSION_DELETE)
    <script>
        $(function () {
            var $deleteLogModal = $('div#delete-log-modal'),
                $deleteLogForm  = $('form#delete-log-form'),
                deleteLogAction = $deleteLogForm.attr('action');

            $('a[href="#delete-log-modal"]').on('click', function(event) {
                event.preventDefault();
                var date = $(this).attr('data-log-date');

                $deleteLogForm.attr('action', deleteLogAction.replace(':date', date));
                $deleteLogModal.find('.modal-body p').html(
                    '{!! trans("foundation::log-viewer.modals.delete.message") !!}'.replace(':date', date)
                );

                $deleteLogModal.modal('show');
            });

            $deleteLogForm.on('submit', function(event) {
                event.preventDefault();
                var submitBtn = $deleteLogForm.find('button[type="submit"]');

                submitBtn.button('loading');

                axios.delete($deleteLogForm.attr('action'))
                     .then(function (response) {
                         if (response.data.code === 'success') {
                             $deleteLogModal.modal('hide');
                             location.reload();
                         }
                         else {
                             alert('AJAX ERROR ! Check the console !');
                             submitBtn.button('reset');
                         }
                     })
                     .catch(function (error) {
                         alert('AJAX ERROR ! Check the console !');
                         console.log(error);
                         submitBtn.button('reset');
                     });

                return false;
            });

            $deleteLogModal.on('hidden.bs.modal', function() {
                $deleteLogForm.attr('action', deleteLogAction);
                $deleteLogModal.find('.modal-body p').html('');
            });
        });
    </script>
    @endcan
@endsection
