@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-users"></i> @lang('Users') <small>@lang("User's details")</small>
@endsection

<?php /** @var  App\Models\User|mixed  $user */ ?>

@section('content')
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card card-borderless shadow-sm">
                <div class="card-body d-flex justify-content-center p-3">
                    <div class="avatar avatar-xxl bg-light">{{ $user->avatar_img }}</div>
                </div>
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Full Name')</td>
                            <td class="text-right small">{{ $user->full_name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Email')</td>
                            <td class="text-right small">
                                {{ $user->email }}
                                @if ($user->hasVerifiedEmail())
                                    <i class="far fa-check-circle text-primary" data-toggle="tooltip" title="@lang('Verified')"></i>
                                @endif
                            </td>
                        </tr>
                        @if ($user->hasVerifiedEmail())
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Email Verified at')</td>
                            <td class="text-muted text-right small">{{ $user->email_verified_at }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Status')</td>
                            <td class="text-right">
                                @if ( ! $user->isActive())
                                    <span class="badge border border-success text-muted">
                                        <i class="fas fa-fw fa-check text-success"></i> @lang('Activated')
                                    </span>
                                @else
                                    <span class="badge border border-secondary text-muted">
                                        <i class="fas fa-fw fa-ban text-secondary"></i> @lang('Deactivated')
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Last activity')</td>
                            <td class="text-right text-muted small">{{ $user->last_activity }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Created at')</td>
                            <td class="text-right text-muted small">{{ $user->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Updated at')</td>
                            <td class="text-right text-muted small">{{ $user->updated_at }}</td>
                        </tr>
                        @if ($user->trashed())
                            <tr>
                                <td class="font-weight-light text-uppercase text-muted">@lang('Deleted at')</td>
                                <td class="text-right text-muted small">{{ $user->deleted_at }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="card-footer text-right px-2">
                    <div class="input-group justify-content-end">
                        {{-- EDIT --}}
                        @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('update'), [$user])
                            <a href="{{ route('admin::auth.users.edit', [$user]) }}"
                               class="btn btn-sm btn-light">@lang('Edit')</a>
                        @endcan

                        <button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-fw fa-ellipsis-v"></i> <span class="sr-only">@lang('Toggle Dropdown')</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            {{-- IMPERSONATE --}}
                            @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('impersonate'), [$user])
                                <li>
                                    <a href="{{ route('admin::auth.users.impersonate', [$user]) }}"
                                       class="dropdown-item">@lang('Impersonate')</a>
                                </li>
                            @endcan

                            {{-- ACTIVATE --}}
                            @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('activate'), [$user])
                                <li>
                                    <button onclick="ARCANESOFT.emit('auth::users.activate')" class="dropdown-item">
                                        @lang($user->isActive() ? 'Deactivate' : 'Activate')
                                    </button>
                                </li>
                            @endcan

                            {{-- RESTORE --}}
                            @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('restore'), [$user])
                                <li>
                                    <button onclick="ARCANESOFT.emit('auth::users.restore')" class="dropdown-item">
                                        @lang('Restore')
                                    </button>
                                </li>
                            @endcan

                            {{-- DELETE --}}
                            @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('delete'), [$user])
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <button class="dropdown-item text-danger"
                                            onclick="ARCANESOFT.emit('auth::users.delete')">
                                        @lang('Delete')
                                    </button>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            @if ($user->linkedAccounts->isNotEmpty())
            <div class="card card-borderless shadow-sm">
                <div class="card-header px-2">@lang('Linked Accounts')</div>
                <table class="table table-borderless mb-0">
                    <thead>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Provider')</td>
                            <td class="font-weight-light text-uppercase text-muted text-center">@lang('Created at')</td>
                            <td class="font-weight-light text-uppercase text-muted text-center">@lang('Updated at')</td>
                            <td class="font-weight-light text-uppercase text-muted text-right">@lang('Actions')</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->linkedAccounts as $linkedAccount)
                        <tr>
                            <td>{{ $linkedAccount->name }}</td>
                            <td class="small text-muted text-center">{{ $linkedAccount->created_at }}</td>
                            <td class="small text-muted text-center">{{ $linkedAccount->updated_at }}</td>
                            <td class="text-right"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
@endsection

{{-- ACIVATE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('activate'), [$user])
    @push('modals')
        <div class="modal fade" id="activate-user-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="activateUserTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.users.activate', $user], 'method' => 'PUT', 'id' => 'activate-user-form']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="activateUserTitle">@lang($user->isActive() ? 'Deactivate User' : 'Activate User')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="activateUserMessage" class="modal-body">
                        @lang($user->isActive() ? 'Are you sure you want to deactivate user ?' : 'Are you sure you want to activate user ?')
                    </div>
                    <div class="modal-footer justify-content-between">
                        {{ arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                        {{ arcanesoft\ui\action_button($user->isActive() ? 'deactivate' : 'activate')->submit() }}
                    </div>
                </div>
                {{ form()->close() }}
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            let activateUserModal = twbs.Modal.make('div#activate-user-modal')
            let activateUserForm  = components.form('form#activate-user-form')

            ARCANESOFT.on('auth::users.activate', () => {
                activateUserModal.show()
            })

            activateUserForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = components.loadingButton(
                    activateUserForm.elt().querySelector('button[type="submit"]')
                );
                submitBtn.loading()

                ARCANESOFT
                    .request()
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
    @endpush
@endcan

{{-- DELETE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('delete'), [$user])
    @push('modals')
        <div class="modal fade" id="delete-user-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="deleteUserTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.users.delete', $user], 'method' => 'DELETE', 'id' => 'delete-user-form']) }}
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
    @endpush

    @push('scripts')
        <script>
            let deleteUserModal = twbs.Modal.make('div#delete-user-modal')
            let deleteUserForm  = components.form('form#delete-user-form')

            ARCANESOFT.on('auth::users.delete', () => {
                deleteUserModal.show()
            })

            deleteUserForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = components.loadingButton(
                    deleteUserForm.elt().querySelector('button[type="submit"]')
                )
                submitBtn.loading()

                ARCANESOFT
                    .request()
                    .delete(deleteUserForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            deleteUserModal.hide()
                            @if ($user->trashed())
                            location.replace("{{ route('admin::auth.users.index') }}")
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
    @endpush
@endcan

{{-- RESTORE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('restore'), [$user])
    @push('modals')
        <div class="modal fade" id="restore-user-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="restoreUserTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.users.restore', ':id'], 'method' => 'PUT', 'id' => 'restore-user-form']) }}
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
    @endpush

    @push('scripts')
        <script>
            let restoreUserModal = twbs.Modal.make('div#restore-user-modal')
            let restoreUserForm  = components.form('form#restore-user-form')

            ARCANESOFT.on('auth::users.restore', () => {
                restoreUserModal.show()
            })

            restoreUserForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = components.loadingButton(
                    restoreUserForm.elt().querySelector('button[type="submit"]')
                );
                submitBtn.loading()

                ARCANESOFT
                    .request()
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
    @endpush
@endcan
