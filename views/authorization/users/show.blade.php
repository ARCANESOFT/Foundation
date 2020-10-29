@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-users"></i> @lang('Users') <small>@lang("User's details")</small>
@endsection

<?php /** @var  App\Models\User|mixed  $user */ ?>

@section('content')
    <div class="row g-4">
        <div class="col-lg-5">
            <x-arc:card>
                <x-arc:card-body class="d-flex justify-content-center">
                    <div class="avatar avatar-xxl rounded-circle bg-light">
                        <img src="{{ $user->avatar }}" alt="{{ $user->full_name }}">
                    </div>
                </x-arc:card-body>
                <x-arc:card-table>
                    <tbody>
                        <tr>
                            <x-arc:table-th label="Full Name"/>
                            <td class="text-right small">{{ $user->full_name }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Email"/>
                            <td class="text-right small">
                                {{ $user->email }}
                                @if ($user->hasVerifiedEmail())
                                    <i class="far fa-check-circle text-primary" data-toggle="tooltip" title="@lang('Verified')"></i>
                                @endif
                            </td>
                        </tr>
                        @if ($user->hasVerifiedEmail())
                        <tr>
                            <x-arc:table-th label="Email Verified at"/>
                            <td class="text-muted text-right small">{{ $user->email_verified_at }}</td>
                        </tr>
                        @endif
                        <tr>
                            <x-arc:table-th label="Status"/>
                            <td class="text-right">
                                @if ($user->isActive())
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
                            <x-arc:table-th label="Last Activity"/>
                            <td class="text-right text-muted small">{{ $user->last_activity }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Created at"/>
                            <td class="text-right text-muted small">{{ $user->created_at }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Updated at"/>
                            <td class="text-right text-muted small">{{ $user->updated_at }}</td>
                        </tr>
                        @if ($user->trashed())
                            <tr>
                                <x-arc:table-th label="Deleted at"/>
                                <td class="font-weight-light text-uppercase text-muted">@lang('Deleted at')</td>
                                <td class="text-right text-muted small">{{ $user->deleted_at }}</td>
                            </tr>
                        @endif
                    </tbody>
                </x-arc:card-table>
                <x-arc:card-footer class="d-flex justify-content-end">
                    {{-- UPDATE --}}
                    @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('update'), [$user])
                        <a href="{{ route('admin::authorization.users.edit', [$user]) }}"
                           class="btn btn-sm btn-secondary">@lang('Edit')</a>
                    @endcan

                    {{-- IMPERSONATE --}}
                    @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('impersonate'), [$user])
                        <a href="{{ route('admin::authorization.users.impersonate', [$user]) }}"
                           class="btn btn-sm btn-secondary ml-2">@lang('Impersonate')</a>
                    @endcan

                    {{-- ACTIVATE --}}
                    @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('activate'), [$user])
                        <button class="btn btn-sm btn-secondary ml-2"
                                onclick="ARCANESOFT.emit('authorization::users.activate')">@lang('Activate')</button>
                    @endcan

                    {{-- DEACTIVATE --}}
                    @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('deactivate'), [$user])
                        <button class="btn btn-sm btn-secondary ml-2"
                                onclick="ARCANESOFT.emit('authorization::users.deactivate')">@lang('Deactivate')</button>
                    @endcan

                    {{-- RESTORE --}}
                    @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('restore'), [$user])
                        <button class="btn btn-sm btn-secondary ml-2"
                                onclick="ARCANESOFT.emit('authorization::users.restore')">@lang('Restore')</button>
                    @endcan

                    {{-- DELETE --}}
                    @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('delete'), [$user])
                        <button class="btn btn-sm btn-danger ml-2"
                                onclick="ARCANESOFT.emit('authorization::users.delete')">@lang('Delete')</button>
                    @endcan
                </x-arc:card-footer>
            </x-arc:card>
        </div>
        <div class="col-lg-7">
            @if ($user->linkedAccounts->isNotEmpty())
                <x-arc:card>
                    <x-arc:card-header>@lang('Linked Accounts')</x-arc:card-header>
                    <x-arc:card-table>
                        <thead>
                            <tr>
                                <x-arc:table-th label="Provider"/>
                                <x-arc:table-th label="Created at" class="text-center"/>
                                <x-arc:table-th label="Updated at" class="text-center"/>
                                <x-arc:table-th label="Actions" class="text-right"/>
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
                    </x-arc:card-table>
                </x-arc:card>
            @endif
        </div>
    </div>
@endsection

{{-- ACIVATE MODAL --}}
@can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('activate'), [$user])
    @push('modals')
        <x-arc:modal-action
            type="activate"
            action="{{ route('admin::authorization.users.activate', [$user]) }}" method="PUT"
            title="Activate User" body="Are you sure you want to activate this user ?"
        />
    @endpush

    @push('scripts')
        <script defer>
            let activateModal = components.modal('div#activate-modal')
            let activateForm  = components.form('form#activate-form')

            ARCANESOFT.on('authorization::users.activate', () => {
                activateModal.show()
            });

            activateForm.onSubmit('PUT', () => {
                activateModal.hide()
                location.reload()
            })
        </script>
    @endpush
@endcan

{{-- ACIVATE MODAL --}}
@can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('deactivate'), [$user])
    @push('modals')
        <x-arc:modal-action
            type="deactivate"
            action="{{ route('admin::authorization.users.deactivate', [$user]) }}" method="PUT"
            title="Deactivate User" body="Are you sure you want to deactivate this user ?"
        />
    @endpush

    @push('scripts')
        <script defer>
            let deactivateModal = components.modal('div#deactivate-modal')
            let deactivateForm  = components.form('form#deactivate-form')

            ARCANESOFT.on('authorization::users.deactivate', () => {
                deactivateModal.show()
            });

            deactivateForm.onSubmit('PUT', () => {
                deactivateModal.hide()
                location.reload()
            })
        </script>
    @endpush
@endcan

{{-- DELETE MODAL --}}
@can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('delete'), [$user])
    @push('modals')
        <x-arc:modal-action
            type="delete"
            action="{{ route('admin::authorization.users.delete', [$user]) }}" method="DELETE"
            title="Delete User"
            body="Are you sure you want to delete this user ?"
        />
    @endpush

    @push('scripts')
        <script defer>
            let deleteModal = components.modal('div#delete-modal')
            let deleteForm  = components.form('form#delete-form')

            ARCANESOFT.on('authorization::users.delete', () => {
                deleteModal.show()
            })

            deleteForm.onSubmit('DELETE', () => {
                deleteModal.hide()
                @if ($user->trashed())
                location.replace("{{ route('admin::authorization.users.index') }}")
                @else
                location.reload()
                @endif
            })
        </script>
    @endpush
@endcan

{{-- RESTORE MODAL --}}
@if($user->trashed())
@can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('restore'), [$user])
    @push('modals')
        <x-arc:modal-action
            type="restore"
            action="{{ route('admin::authorization.users.restore', [$user]) }}" method="PUT"
            title="Restore User"
            body="Are you sure you want to restore this user ?"
        />
    @endpush

    @push('scripts')
        <script defer>
            let restoreModal = components.modal('div#restore-modal')
            let restoreForm  = components.form('form#restore-form')

            ARCANESOFT.on('authorization::users.restore', () => {
                restoreModal.show()
            });

            restoreForm.onSubmit('PUT', () => {
                restoreModal.hide()
                location.reload()
            })
        </script>
    @endpush
@endcan
@endif
