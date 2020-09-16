@extends(arcanesoft\foundation()->template())

<?php /** @var  Arcanesoft\Foundation\Auth\Models\Administrator  $administrator */ ?>

@section('page-title')
    <i class="fa fa-fw fa-user-secret"></i> @lang('Administrators') <small>@lang('Administrator\'s details')</small>
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card card-borderless shadow-sm">
                <div class="card-body d-flex justify-content-center p-3">
                    <div class="avatar avatar-xxl rounded-circle bg-light">
                        {{ html()->image($administrator->avatar, $administrator->full_name, []) }}
                    </div>
                </div>
                <table class="table table-md table-borderless mb-0">
                    <tbody>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Full Name')</td>
                            <td class="text-right">{{ $administrator->full_name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Email')</td>
                            <td class="small text-right">
                                {{ $administrator->email }}
                                @if ($administrator->hasVerifiedEmail())
                                    <i class="far fa-check-circle text-primary"
                                       data-toggle="tooltip" title="@lang('Verified')"></i>
                                @endif
                            </td>
                        </tr>
                        @if ($administrator->hasVerifiedEmail())
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Email Verified at')</td>
                            <td class="text-right">
                                <small class="text-muted">{{ $administrator->email_verified_at }}</small>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Status')</td>
                            <td class="text-right">
                                @if ($administrator->isActive())
                                    <span class="badge border border-success text-muted">
                                        <i class="fas fa-fw fa-check"></i> @lang('Activated')
                                    </span>
                                @else
                                    <span class="badge border border-secondary text-muted">
                                        <i class="fas fa-fw fa-ban"></i> @lang('Deactivated')
                                    </span>
                                @endif
                                @if ($administrator->isSuperAdmin())
                                    <span class="badge border border-warning text-muted"
                                          data-toggle="tooltip" data-placement="top" title="@lang('Super Administrator')">
                                        <i class="fas fa-crown"></i>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Last activity')</td>
                            <td class="text-right"><small class="text-muted">{{ $administrator->last_activity }}</small></td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Created at')</td>
                            <td class="text-right"><small class="text-muted">{{ $administrator->created_at }}</small></td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Updated at')</td>
                            <td class="text-right"><small class="text-muted">{{ $administrator->updated_at }}</small></td>
                        </tr>
                        @if ($administrator->trashed())
                            <tr>
                                <td class="font-weight-light text-uppercase text-muted">@lang('Deleted at')</td>
                                <td class="text-right"><small class="text-muted">{{ $administrator->deleted_at }}</small></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="card-footer text-right px-2">
                    <div class="input-group justify-content-end">
                        {{-- UPDATE --}}
                        @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('update'), [$administrator])
                            <a href="{{ route('admin::auth.administrators.edit', [$administrator]) }}"
                               class="btn btn-sm btn-light">@lang('Edit')</a>
                        @else
                            <button class="btn btn-sm btn-light" tabindex="-1" aria-disabled="true">
                                @lang('Edit')
                            </button>
                        @endcan

                        {{-- DROPDOWN --}}
                        <button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-fw fa-ellipsis-v"></i> <span class="sr-only">@lang('Toggle Dropdown')</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            {{-- ACTIVATE --}}
                            <li>
                                @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('activate'), [$administrator])
                                    <button class="dropdown-item"
                                            onclick="Foundation.$emit('authorization::administrators.activate')">
                                        @lang($administrator->isActive() ? 'Deactivate' : 'Activate')
                                    </button>
                                @else
                                    <button class="dropdown-item disabled" tabindex="-1" aria-disabled="true">
                                        @lang($administrator->isActive() ? 'Deactivate' : 'Activate')
                                    </button>
                                @endcan
                            </li>

                            {{-- RESTORE --}}
                            @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('restore'), [$administrator])
                                <li>
                                    <button class="dropdown-item"
                                            onclick="Foundation.$emit('authorization::administrators.restore')">
                                        @lang('Restore')
                                    </button>
                                </li>
                            @endcan

                            <li><hr class="dropdown-divider"></li>

                            {{-- DELETE --}}
                            <li>
                                @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('delete'), [$administrator])
                                    <button class="dropdown-item text-danger"
                                            onclick="Foundation.$emit('authorization::administrators.delete')">
                                        @lang('Delete')
                                    </button>
                                @else
                                    <button class="dropdown-item disabled" tabindex="-1" aria-disabled="true">
                                        @lang('Delete')
                                    </button>
                                @endcan
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="row g-4">
                {{-- ROLES --}}
                <div class="col-12">
                    <div class="card card-borderless shadow-sm">
                        <div class="card-header px-2">@lang('Roles')</div>
                        <table class="table table-borderless table-hover table-md mb-0">
                            <thead>
                            <tr>
                                <th class="font-weight-light text-uppercase text-muted">@lang('Name')</th>
                                <th class="font-weight-light text-uppercase text-muted">@lang('Description')</th>
                                <th class="font-weight-light text-uppercase text-muted text-right">@lang('Actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($administrator->roles as $role)
                                <?php /** @var  Arcanesoft\Foundation\Auth\Models\Role  $role */ ?>
                                <tr>
                                    <td class="small">{{ $role->name }}</td>
                                    <td class="small">{{ $role->description }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin::auth.roles.show', [$role]) }}" class="btn btn-sm btn-light"
                                           data-toggle="tooltip" title="@lang('Show')">
                                            <i class="far fa-fw fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">@lang('The list is empty !')</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- SESSION --}}
                <div class="col-12">
                    <div class="card card-borderless shadow-sm">
                        <div class="card-header px-2">@lang('Sessions')</div>
                        <table class="table table-borderless table-hover table-md mb-0">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="font-weight-light text-uppercase text-muted">@lang('IP')</th>
                                <th class="font-weight-light text-uppercase text-muted">@lang('Device')</th>
                                <th class="font-weight-light text-uppercase text-muted">@lang('Last activity')</th>
                                <th class="font-weight-light text-uppercase text-muted text-right">@lang('Actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($administrator->sessions as $session)
                                <tr>
                                    <td>
                                        {{ $session->device_icon }}
                                        @if ($session->isCurrent())
                                            <span class="status bg-success status-animated"
                                                  title="@lang('Your current session')" data-toggle="tooltip"></span>
                                        @endif
                                    </td>
                                    <td class="small">{{ $session->ip_address }}</td>
                                    <td class="small">@lang(':client on :os', ['client' => $session->client_name, 'os' => $session->os_name])</td>
                                    <td class="small">{{ $session->last_activity_at->diffForHumans() }}</td>
                                    <td></td>
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

@push('modals')
    {{-- ACIVATE MODAL --}}
    @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('activate'), [$administrator])
        <div class="modal fade" id="activate-user-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="activateUserTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.administrators.activate', $administrator], 'method' => 'PUT', 'id' => 'activate-user-form']) }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="activateUserTitle">@lang($administrator->isActive() ? 'Deactivate User' : 'Activate User')</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="activateUserMessage" class="modal-body">
                            @lang($administrator->isActive() ? 'Are you sure you want to deactivate user ?' : 'Are you sure you want to activate user ?')
                        </div>
                        <div class="modal-footer justify-content-between">
                            {{ arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                            {{ arcanesoft\ui\action_button($administrator->isActive() ? 'deactivate' : 'activate')->submit() }}
                        </div>
                    </div>
                {{ form()->close() }}
            </div>
        </div>
    @endcan

    {{-- DELETE MODAL --}}
    @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('delete'), [$administrator])
        <div class="modal fade" id="delete-user-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="deleteUserTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.administrators.delete', $administrator], 'method' => 'DELETE', 'id' => 'delete-user-form']) }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="deleteUserTitle">@lang('Delete User')</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @lang('Are you sure you want to delete this user ?')
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

    {{-- RESTORE MODAL --}}
    @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('restore'), [$administrator])
        <div class="modal fade" id="restore-user-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="restoreUserTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.administrators.restore', $administrator], 'method' => 'PUT', 'id' => 'restore-user-form']) }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="restoreUserTitle">@lang('Restore User')</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @lang('Are you sure you want to restore this user ?')
                        </div>
                        <div class="modal-footer justify-content-between">
                            {{ arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                            {{ arcanesoft\ui\action_button('restore')->submit() }}
                        </div>
                    </div>
                {{ form()->close() }}
            </div>
        </div>
    @endcan
@endpush

@push('scripts')
    {{-- ACTIVATE SCRIPT --}}
    @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('activate'), [$administrator])
        <script>
            let activateUserModal = twbs.Modal.make('div#activate-user-modal')
            let activateUserForm  = Form.make('form#activate-user-form')

            Foundation.$on('authorization::administrators.activate', () => {
                activateUserModal.show()
            });

            activateUserForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = Foundation.ui.loadingButton(
                    activateUserForm.elt().querySelector('button[type="submit"]')
                )
                submitBtn.loading()

                request()
                    .put(activateUserForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            activateUserModal.hide()
                            location.reload()
                        }
                        else {
                            alert('ERROR ! Check the console !')
                            submitBtn.reset()
                        }
                    })
                    .catch((error) => {
                        alert('AJAX ERROR ! Check the console !')
                        console.log(error)
                        submitBtn.reset()
                    })
            })
        </script>
    @endcan

    {{-- DELETE SCRIPT --}}
    @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('delete'), [$administrator])
        <script>
            let deleteUserModal = twbs.Modal.make('div#delete-user-modal')
            let deleteUserForm  = Form.make('form#delete-user-form')

            Foundation.$on('authorization::administrators.delete', () => {
                deleteUserModal.show()
            })

            deleteUserForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = Foundation.ui.loadingButton(
                    deleteUserForm.elt().querySelector('button[type="submit"]')
                )
                submitBtn.loading()

                request()
                    .delete(deleteUserForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            deleteUserModal.hide()
                            @if ($administrator->trashed())
                            location.replace("{{ route('admin::auth.administrators.index') }}")
                            @else
                            location.reload()
                            @endif
                        }
                        else {
                            alert('ERROR ! Check the console !')
                            submitBtn.reset()
                        }
                    })
                    .catch((error) => {
                        alert('AJAX ERROR ! Check the console !')
                        console.log(error)
                        submitBtn.reset()
                    })
            })
        </script>
    @endcan

    {{-- RESTORE SCRIPT --}}
    @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('restore'), [$administrator])
        <script>
            let restoreUserModal = twbs.Modal.make('div#restore-user-modal')
            let restoreUserForm  = Form.make('form#restore-user-form')

            Foundation.$on('authorization::administrators.restore', () => {
                restoreUserModal.show()
            });

            restoreUserForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = Foundation.ui.loadingButton(
                    restoreUserForm.elt().querySelector('button[type="submit"]')
                )
                submitBtn.loading()

                request()
                    .put(restoreUserForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            restoreUserModal.hide()
                            location.reload()
                        }
                        else {
                            alert('ERROR ! Check the console !')
                            submitBtn.reset()
                        }
                    })
                    .catch((error) => {
                        alert('AJAX ERROR ! Check the console !')
                        console.log(error)
                        submitBtn.reset()
                    })
            })
        </script>
    @endcan
@endpush

