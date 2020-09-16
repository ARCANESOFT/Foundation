@extends(arcanesoft\foundation()->template())

<?php
/**
 * @var  Arcanesoft\Foundation\Auth\Models\Role  $role
 * @var  string                                  $tab
 */
?>

@section('page-title')
    <i class="fas fa-fw fa-user-tag"></i> @lang('Roles') <small>@lang("Role's details")</small>
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-lg-4">
            {{-- ROLE --}}
            <div class="card card-borderless shadow-sm">
                <div class="card-header d-flex align-items-center justify-content-between px-2">
                    <span>@lang('Role')</span>
                </div>
                <table class="table table-borderless table-md mb-0">
                    <tbody>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Name')</td>
                            <td class="text-right small">{{ $role->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Description')</td>
                            <td class="text-right small">{{ $role->description }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Users')</td>
                            <td class="text-right">
                                {{ arcanesoft\ui\count_pill($role->administrators->count()) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Permissions')</td>
                            <td class="text-right">
                                {{ arcanesoft\ui\count_pill($role->permissions->count()) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Locked')</td>
                            <td class="text-right">
                                @if ($role->isLocked())
                                    <span class="badge border border-danger text-muted">
                                        <i class="fa fa-lock text-danger mr-1"></i> @lang('Locked')
                                    </span>
                                @else
                                    <span class="badge border border-secondary text-muted">
                                        <i class="fa fa-unlock text-secondary mr-1"></i> @lang('Unlocked')
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Status')</td>
                            <td class="text-right">
                                @if ($role->isActive())
                                    <span class="badge border border-success text-muted">
                                        <i class="fa fa-check text-success mr-1"></i> @lang('Activated')
                                    </span>
                                @else
                                    <span class="badge border border-secondary text-muted">
                                        <i class="fa fa-ban text-secondary mr-1"></i> @lang('Deactivated')
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Created at')</td>
                            <td class="text-muted text-right small">{{ $role->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Updated at')</td>
                            <td class="text-muted text-right small">{{ $role->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer px-2">
                    <div class="input-group justify-content-end">
                        @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('update'), [$role])
                            <a href="{{ route('admin::auth.roles.edit', [$role]) }}"
                               class="btn btn-sm btn-light">@lang('Edit')</a>
                        @endcan

                        <button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-fw fa-ellipsis-v"></i> <span class="sr-only">@lang('Toggle Dropdown')</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('activate'), [$role])
                                <li>
                                    <button class="dropdown-item"
                                            onclick="Foundation.$emit('auth::roles.activate')">
                                        @lang($role->isActive() ? 'Deactivate' : 'Activate')
                                    </button>
                                </li>
                            @endcan

                            @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('delete'), [$role])
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <button class="dropdown-item text-danger"
                                            onclick="Foundation.$emit('auth::roles.delete')">
                                        @lang('Delete')
                                    </button>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card card-borderless shadow-sm">
                <div class="card-header d-flex justify-content-end p-2">
                    <div class="btn-group" role="group" aria-label="Administrators and Permissions">
                        <a href="{{ route('admin::auth.roles.show', [$role]) }}" class="btn btn-sm btn-light {{ $tab === 'administrators' ? 'active' : '' }}">@lang('Administrators')</a>
                        <a href="{{ route('admin::auth.roles.show', [$role, 'tab' => 'permissions']) }}" class="btn btn-sm btn-light {{ $tab === 'permissions' ? 'active' : '' }}">@lang('Permissions')</a>
                    </div>
                </div>
                @includeWhen($tab === 'administrators', 'foundation::authorization.roles._includes.role-administrators-table', ['role' => $role])
                @includeWhen($tab === 'permissions', 'foundation::authorization.roles._includes.role-permissions-table', ['role' => $role])
            </div>
        </div>
    </div>
@endsection

@push('modals')
    {{-- ACIVATE MODAL --}}
    @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('activate'), [$role])
        <div class="modal fade" id="activate-role-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="activateRoleTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.roles.activate', $role], 'method' => 'PUT', 'id' => 'activate-role-form']) }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="activateRoleTitle">@lang($role->isActive() ? 'Deactivate Role' : 'Activate Role')</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @lang($role->isActive() ? 'Are you sure you want to deactivate role ?' : 'Are you sure you want to activate role ?')
                        </div>
                        <div class="modal-footer justify-content-between">
                            {{ arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                            {{ arcanesoft\ui\action_button($role->isActive() ? 'deactivate' : 'activate')->submit() }}
                        </div>
                    </div>
                {{ form()->close() }}
            </div>
        </div>
    @endcan

    {{-- DELETE MODAL --}}
    @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('delete'), [$role])
        <div class="modal fade" id="delete-role-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.roles.delete', $role], 'method' => 'DELETE', 'id' => 'delete-role-form']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">@lang('Delete Role')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @lang('Are you sure you want to delete this role ?')
                    </div>
                    <div class="modal-footer justify-content-between">
                        {{ arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                        {{ arcanesoft\ui\action_button('delete')->submit() }}
                    </div>
                </div>
                {{ form()->close() }}
            </div>
        </div>
    @endcan
@endpush

@push('scripts')
    {{-- ACTIVATE SCRIPT --}}
    @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('activate'), [$role])
        <script defer>
        let activateRoleModal = twbs.Modal.make('div#activate-role-modal')
        let activateRoleForm  = Form.make('form#activate-role-form')

        Foundation.$on('auth::roles.activate', () => {
            activateRoleModal.show()
        });

        activateRoleForm.on('submit', (event) => {
            event.preventDefault()

            let submitBtn = Foundation.ui.loadingButton(
                activateRoleForm.elt().querySelector('button[type="submit"]:not([style*="display: none"])')
            )
            submitBtn.loading()

            request()
                .put(activateRoleForm.getAction())
                .then((response) => {
                    if (response.data.code === 'success') {
                        activateRoleModal.hide()
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
        </script>
    @endcan

    {{-- DELETE SCRIPT --}}
    @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('delete'), [$role])
        <script defer>
            let deleteRoleModal = twbs.Modal.make('div#delete-role-modal')
            let deleteRoleForm  = Form.make('form#delete-role-form')

            Foundation.$on('auth::roles.delete', () => {
                deleteRoleModal.show()
            })

            deleteRoleForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = Foundation.ui.loadingButton(
                    deleteRoleForm.elt().querySelector('button[type="submit"]')
                )
                submitBtn.loading()

                request()
                    .delete(deleteRoleForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            deleteRoleModal.hide()
                            location.replace("{{ route('admin::auth.roles.index') }}")
                        }
                        else {
                            alert('ERROR ! Check the console !')
                            submitBtn.button('reset')
                        }
                    })
                    .catch((error) => {
                        alert('AJAX ERROR ! Check the console !')
                        console.log(error)
                        submitBtn.button('reset')
                    })
            })
        </script>
    @endcan
@endpush
