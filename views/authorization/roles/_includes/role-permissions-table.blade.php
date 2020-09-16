<?php /** @var  Arcanesoft\Foundation\Auth\Models\Role  $role */ ?>

@if($role->permissions->isNotEmpty())
    <table id="permissions-table" class="table table-borderless table-hover mb-0">
        <thead>
            <tr>
                <th class="font-weight-light text-uppercase text-muted">@lang('Group')</th>
                <th class="font-weight-light text-uppercase text-muted">@lang('Category')</th>
                <th class="font-weight-light text-uppercase text-muted">@lang('Name')</th>
                <th class="font-weight-light text-uppercase text-muted">@lang('Description')</th>
                <th class="font-weight-light text-uppercase text-muted text-right">@lang('Actions')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($role->permissions as $permission)
            <tr>
                <td class="small">{{ $permission->group->name }}</td>
                <td class="small">{{ $permission->category }}</td>
                <td class="small">{{ $permission->name }}</td>
                <td class="small">{{ $permission->description }}</td>
                <td>
                    <div class="input-group justify-content-end">
                        @can(Arcanesoft\Foundation\Auth\Policies\PermissionsPolicy::ability('show'), [$permission])
                            <a href="{{ route('admin::auth.permissions.show', [$permission]) }}"
                               class="btn btn-sm btn-light" data-toggle="tooltip" title="@lang('Show')">
                                <i class="far fa-fw fa-eye"></i>
                            </a>
                        @endcan

                        @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('permissions.detach'), [$role, $permission])
                            <button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-fw fa-ellipsis-v"></i> <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <button class="dropdown-item font-weight-bold text-danger"
                                            onclick="Foundation.$emit('auth::roles.permissions.detach', {id: '{{ $permission->getRouteKey() }}'})">
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
    @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('permissions.detach'), [$role])
        @push('modals')
        <div class="modal fade" id="detach-permission-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="detach-permission-modal-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.roles.permissions.detach', $role, ':id'], 'method' => 'DELETE', 'id' => 'detach-permission-form']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="detach-permission-modal-title">@lang('Detach Permission')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @lang('Are you sure you want to detach permission ?')
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button data-dismiss="modal" class="btn btn-danger">
                            @lang('Detach')
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
            let detachPermissionModal  = twbs.Modal.make('div#detach-permission-modal')
            let detachPermissionForm   = Form.make('form#detach-permission-form')
            let detachPermissionAction = detachPermissionForm.getAction()

            Foundation.$on('auth::roles.permissions.detach', ({id}) => {
                detachPermissionForm.setAction(detachPermissionAction.replace(':id', id))
                detachPermissionModal.show()
            })

            detachPermissionForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = Foundation.ui.loadingButton(
                    detachPermissionForm.elt().querySelector('button[type="submit"]')
                )
                submitBtn.loading()

                request()
                    .delete(detachPermissionForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            detachPermissionModal.hide()
                            location.reload()
                        }
                        else {
                            alert('ERROR ! Check the console !')
                            submitBtn.reset()
                        }
                    })
                    .catch((error) => {
                        alert('AJAX ERROR ! Check the console !');
                        submitBtn.reset();
                    })
            })

            detachPermissionModal.on('hidden', () => {
                detachPermissionForm.setAction(detachPermissionAction);
            })
        </script>
        @endpush
    @endcan
@else
    @include('foundation::_partials.no-data-found')
@endif


