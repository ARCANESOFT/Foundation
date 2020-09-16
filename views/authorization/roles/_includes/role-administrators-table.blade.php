<?php /** @var  Arcanesoft\Foundation\Auth\Models\Role  $role */ ?>

@if($role->administrators->isNotEmpty())
    <table id="administrators-table" class="table table-borderless table-hover mb-0">
        <thead>
            <tr>
                <th></th>
                <th class="font-weight-light text-uppercase text-muted">@lang('Full Name')</th>
                <th class="font-weight-light text-uppercase text-muted">@lang('Email')</th>
                <th class="font-weight-light text-uppercase text-muted text-center">@lang('Created at')</th>
                <th class="font-weight-light text-uppercase text-muted text-center">@lang('Status')</th>
                <th class="font-weight-light text-uppercase text-muted text-right">@lang('Actions')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($role->administrators as $administrator)
            <tr>
                <td>
                    <div class="avatar avatar-sm rounded-circle bg-light">
                        <img src="{{ $administrator->avatar }}" alt="{{ $administrator->full_name }}">
                    </div>
                </td>
                <td><small>{{ $administrator->full_name }}</small></td>
                <td><small>{{ $administrator->email }}</small></td>
                <td class="text-center"><small>{{ $administrator->created_at }}</small></td>
                <td class="text-center">
                    <span class="status {{ $administrator->isActive() ? 'status-animated bg-success' : 'bg-secondary' }}" data-toggle="tooltip" data-placement="top" title="{{ $administrator->isActive() ? __('Activated') : __('Deactivated') }}"></span>
                </td>
                <td>
                    <div class="input-group justify-content-end">
                        @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('show'), $administrator)
                            <a href="{{ route('admin::auth.administrators.show', [$administrator]) }}"
                               class="btn btn-sm btn-light" data-toggle="tooltip" title="@lang('Show')">
                                <i class="far fa-fw fa-eye"></i>
                            </a>
                        @endcan

                        @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('administrators.detach'), [$role, $administrator])
                            <button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-fw fa-ellipsis-v"></i> <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <button class="dropdown-item font-weight-bold text-danger"
                                            onclick="Foundation.$emit('auth::roles.administrators.detach', {id: '{{ $administrator->getRouteKey() }}', name: '{{ $administrator->full_name }}'})">
                                        @lang('Detach')
                                    </button>
                                </li>
                            </ul>
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- DETACH MODAL/SCRIPT --}}
    @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('users.detach'), [$role])
        @push('modals')
            <div class="modal fade" id="detach-administrator-modal" data-backdrop="static"
                 tabindex="-1" role="dialog" aria-labelledby="detach-administrator-modal-title" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    {{ form()->open(['route' => ['admin::auth.roles.administrators.detach', $role, ':id'], 'method' => 'DELETE', 'id' => 'detach-administrator-form']) }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="detach-administrator-modal-title">@lang('Detach Administrators')</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer justify-content-between">
                            <button data-dismiss="modal" class="btn btn-light">
                                @lang('Cancel')
                            </button>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-fw fa-unlink"></i> @lang('Detach')
                            </button>
                        </div>
                    </div>
                    {{ form()->close() }}
                </div>
            </div>
        @endpush

        @push('scripts')
            <script>
                let detachAdministratorModal  = twbs.Modal.make('div#detach-administrator-modal')
                let detachAdministratorForm   = Form.make('form#detach-administrator-form')
                let detachAdministratorAction = detachAdministratorForm.getAction()

                Foundation.$on('auth::roles.administrators.detach', ({id, name}) => {
                    detachAdministratorForm.setAction(detachAdministratorAction.replace(':id', id))

                    detachAdministratorModal._element.querySelector('.modal-body').innerHTML = "@lang('Are you sure you want to detach user: :name ?')".replace(':name', name)

                    detachAdministratorModal.show()
                })

                detachAdministratorForm.on('submit', (event) => {
                    event.preventDefault()

                    let submitBtn = Foundation.ui.loadingButton(
                        detachAdministratorForm.elt().querySelector('button[type="submit"]:not([style*="display: none"])')
                    )
                    submitBtn.loading()

                    request()
                        .delete(detachAdministratorForm.getAction())
                        .then((response) => {
                            if (response.data.code === 'success') {
                                detachAdministratorModal.hide()
                                location.reload()
                            }
                            else {
                                alert('ERROR ! Check the console !')
                                submitBtn.reset()
                            }
                        })
                        .catch((error) => {
                            alert('AJAX ERROR ! Check the console !')
                            submitBtn.reset()
                        })
                })

                detachAdministratorModal.on('hidden', () => {
                    detachAdministratorForm.setAction(detachAdministratorAction);
                });
            </script>
        @endpush
    @endcan
@else
    @include('foundation::_partials.no-data-found')
@endif
