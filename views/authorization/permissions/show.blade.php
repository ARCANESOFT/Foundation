@extends(arcanesoft\foundation()->template())

<?php /** @var  Arcanesoft\Foundation\Auth\Models\Permission  $permission */ ?>

@section('page-title')
    <i class="fas fa-fw fa-shield-alt"></i> @lang('Permissions') <small>@lang("Permission's details")</small>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-5 col-lg-4">
            {{-- Permission --}}
            <div class="card card-borderless shadow-sm mb-3">
                <div class="card-header px-2">@lang('Permission')</div>
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Group')</td>
                            <td class="text-right small">{{ $permission->group->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Category')</td>
                            <td class="text-right small">{{ $permission->category }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Name')</td>
                            <td class="text-right small">{{ $permission->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Description')</td>
                            <td class="text-right small">{{ $permission->description }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Roles')</td>
                            <td class="text-right">{{ arcanesoft\ui\count_pill($roles->count()) }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Created at')</td>
                            <td class="text-right small text-muted">{{ $permission->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Gate --}}
            @can(Arcanesoft\Foundation\System\Policies\AbilitiesPolicy::ability('show'))
            <div class="card card-borderless shadow-sm mb-3">
                <div class="card-header px-2">@lang('Gate')</div>
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Ability')</td>
                            <td class="text-right">
                                <div class="badge badge-outline-dark">{{ $permission->ability }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Registered')</td>
                            <td class="text-right">
                                @if ($permission->isAbilityRegistered())
                                    <i class="fas fa-fw fa-check text-success" data-toggle="tooltip" title="@lang('Yes')"></i>
                                @else
                                    <i class="fas fa-fw fa-ban text-secondary" data-toggle="tooltip" title="@lang('No')"></i>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer text-right px-2">
                    <a href="{{ route('admin::system.abilities.show', $permission->ability) }}" class="btn btn-sm btn-light">
                        @lang('Show')
                    </a>
                </div>
            </div>
            @endcan
        </div>
        <div class="col-md-7 col-lg-8">
            {{-- ROLES --}}
            @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('index'))
            <div class="card card-borderless shadow-sm mb-3">
                <div class="card-header px-2">@lang('Roles')</div>
                <table class="table table-borderless table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="font-weight-light text-uppercase text-muted ">@lang('Name')</th>
                            <th class="font-weight-light text-uppercase text-muted ">@lang('Description')</th>
                            <th class="font-weight-light text-uppercase text-muted text-center">@lang('Users')</th>
                            <th class="font-weight-light text-uppercase text-muted text-center">@lang('Locked')</th>
                            <th class="font-weight-light text-uppercase text-muted text-center">@lang('Status')</th>
                            <th class="font-weight-light text-uppercase text-muted text-right">@lang('Actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td class="small">{{ $role->name }}</td>
                                <td class="small">{{ $role->description }}</td>
                                <td class="text-center">{{ arcanesoft\ui\count_pill($role->administrators->count()) }}</td>
                                <td class="text-center">
                                    @if($role->isLocked())
                                        <span class="status status-danger" data-toggle="tooltip" data-placement="top" title="@lang('Locked')"></span>
                                    @else
                                        <span class="status status-secondary" data-toggle="tooltip" data-placement="top" title="@lang('Unlocked')"></span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($role->isActive())
                                        <span class="status status-success status-animated" data-toggle="tooltip" data-placement="top" title="@lang('Activated')"></span>
                                    @else
                                        <span class="status status-secondary" data-toggle="tooltip" data-placement="top" title="@lang('Deactivated')"></span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('show'), [$role])
                                        <a href="{{ route('admin::auth.roles.show', [$role]) }}" class="btn btn-sm btn-light" data-toggle="tooltip" title="@lang('Show')">
                                            <i class="far fa-fw fa-eye"></i>
                                        </a>
                                    @endcan

                                    @can(Arcanesoft\Foundation\Auth\Policies\PermissionsPolicy::ability('roles.detach'), [$permission, $role])
                                        <button class="btn btn-sm btn-danger"
                                                data-toggle="tooltip" data-placement="top" title="@lang('Detach')"
                                                onclick="Foundation.$emit('auth::permissions.detach-role', {id: '{{ $role->getRouteKey() }}', name: '{{ $role->name }}'})">
                                            <i class="fas fa-fw fa-unlink"></i>
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endcan
        </div>
    </div>
@endsection

{{-- DETACH ROLE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\PermissionsPolicy::ability('roles.detach'), $permission)
    @push('modals')
        <div class="modal fade" id="detach-role-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.permissions.roles.detach', $permission, ':id'], 'method' => 'DELETE', 'id' => 'detach-role-form']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">@lang('Detach Role')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer justify-content-between">
                        {{ arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
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
            let detachRoleModal = twbs.Modal.make('div#detach-role-modal')
            let detachRoleForm  = Form.make('form#detach-role-form')
            let detachRoleAction = detachRoleForm.getAction()

            Foundation.$on('auth::permissions.detach-role', ({id, name}) => {
                detachRoleForm.setAction(detachRoleAction.replace(':id', id))

                detachRoleModal._element.querySelector('.modal-body').innerHTML = "@lang('Are you sure you want to detach role: :name ?')".replace(':name', name)

                detachRoleModal.show();
            });

            detachRoleForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = Foundation.ui.loadingButton(
                    detachRoleForm.elt().querySelector('button[type="submit"]')
                )
                submitBtn.loading()

                request()
                    .delete(detachRoleForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            detachRoleModal.hide()
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
            });

            detachRoleModal.on('hidden', () => {
                detachRoleForm.setAction(detachRoleAction);
            });
        </script>
    @endpush
@endcan
