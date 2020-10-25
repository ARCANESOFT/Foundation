
@extends(arcanesoft\foundation()->template())

<?php /** @var  Arcanesoft\Foundation\Auth\Models\Administrator  $administrator */ ?>

@section('page-title')
    <i class="fa fa-fw fa-user-secret"></i> @lang('Administrators') <small>@lang("Administrator's details")</small>
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-lg-5">
            <x-arc:card>
                <x-arc:card-body class="d-flex justify-content-center">
                    <div class="avatar avatar-xxl rounded-circle bg-light">
                        {{ html()->image($administrator->avatar, $administrator->full_name, []) }}
                    </div>
                </x-arc:card-body>
                <x-arc:card-table>
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
                </x-arc:card-table>
                <x-arc:card-footer class="d-flex justify-content-end">
                    {{-- UPDATE --}}
                    @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('update'), [$administrator])
                        <a href="{{ route('admin::auth.administrators.edit', [$administrator]) }}"
                           class="btn btn-sm btn-secondary">@lang('Edit')</a>
                    @endcan

                    {{-- ACTIVATE --}}
                    @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('activate'), [$administrator])
                        <button class="btn btn-sm btn-secondary ml-2" onclick="ARCANESOFT.emit('authorization::administrators.activate')">
                            @lang($administrator->isActive() ? 'Deactivate' : 'Activate')
                        </button>
                    @endcan

                    {{-- RESTORE --}}
                    @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('restore'), [$administrator])
                        <button class="btn btn-sm btn-secondary ml-2" onclick="ARCANESOFT.emit('authorization::administrators.restore')">
                            @lang('Restore')
                        </button>
                    @endcan

                    {{-- DELETE --}}
                    @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('delete'), [$administrator])
                        <button class="btn btn-sm btn-danger ml-2"
                                onclick="ARCANESOFT.emit('authorization::administrators.delete')">
                            @lang('Delete')
                        </button>
                    @endcan
                </x-arc:card-footer>
            </x-arc:card>
        </div>

        <div class="col-lg-7">
            <div class="row row-cols-1 g-4">
                {{-- ROLES --}}
                <div class="col">
                    <x-arc:card>
                        <x-arc:card-header>@lang('Roles')</x-arc:card-header>
                        <x-arc:card-table class="table-hover">
                            <thead>
                                <tr>
                                    <x-arc:table-th label="Name"/>
                                    <x-arc:table-th label="Description"/>
                                    <x-arc:table-th label="Actions" class="text-right"/>
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
                                        <td colspan="3" class="text-muted text-center">@lang('The list is empty !')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </x-arc:card-table>
                    </x-arc:card>
                </div>

                {{-- SESSION --}}
                <div class="col">
                    <x-arc:card>
                        <x-arc:card-header>@lang('Sessions')</x-arc:card-header>
                        <x-arc:card-table class="table-hover">
                            <thead>
                                <tr>
                                    <x-arc:table-th />
                                    <x-arc:table-th label="IP"/>
                                    <x-arc:table-th label="Device"/>
                                    <x-arc:table-th label="Last activity"/>
                                    <x-arc:table-th label="Actions" class="text-right"/>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($administrator->sessions as $session)
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
                            @empty
                                <tr>
                                    <td colspan="5" class="text-muted text-center">@lang('The list is empty !')</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </x-arc:card-table>
                    </x-arc:card>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- ACIVATE MODAL --}}
@can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('activate'), [$administrator])
    @php($actionType = $administrator->isActive() ? 'deactivate' : 'activate')
    @push('modals')
        <x-arc:modal-action
            type="{{ $actionType }}"
            action="{{ route('admin::auth.administrators.activate', [$administrator]) }}" method="PUT"
            title="{{ $administrator->isActive() ? 'Deactivate User' : 'Activate User' }}"
            body="{{ $administrator->isActive() ? 'Are you sure you want to deactivate administrator ?' : 'Are you sure you want to activate administrator ?' }}"
        />
    @endpush

    @push('scripts')
        <script defer>
            let activateModal = components.modal('div#{{ $actionType }}-modal')
            let activateForm  = components.form('form#{{ $actionType }}-form')

            ARCANESOFT.on('authorization::administrators.activate', () => {
                activateModal.show()
            });

            activateForm.onSubmit('PUT', () => {
                activateModal.hide()
                location.reload()
            })
        </script>
    @endpush
@endcan

{{-- DELETE MODAL --}}
@can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('delete'), [$administrator])
    @push('modals')
        <x-arc:modal-action
            type="delete"
            action="{{ route('admin::auth.administrators.delete', [$administrator]) }}" method="DELETE"
            title="Delete Administrator"
            body="Are you sure you want to delete this administrator ?"
        />
    @endpush

    @push('scripts')
        <script defer>
            let deleteModal = components.modal('div#delete-modal')
            let deleteForm  = components.form('form#delete-form')

            ARCANESOFT.on('authorization::administrators.delete', () => {
                deleteModal.show()
            })

            deleteForm.onSubmit('DELETE', () => {
                deleteModal.hide()
                @if ($administrator->trashed())
                location.replace("{{ route('admin::auth.administrators.index') }}")
                @else
                location.reload()
                @endif
            })
        </script>
    @endpush
@endcan

{{-- RESTORE MODAL --}}
@if($administrator->trashed())
@can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('restore'), [$administrator])
    @push('modals')
        <x-arc:modal-action
            type="restore"
            action="{{ route('admin::auth.administrators.restore', [$administrator]) }}" method="PUT"
            title="Restore Administrator"
            body="Are you sure you want to restore this administrator ?"
        />
    @endpush

    @push('scripts')
        <script defer>
            let restoreModal = components.modal('div#restore-modal')
            let restoreForm  = components.form('form#restore-form')

            ARCANESOFT.on('authorization::administrators.restore', () => {
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
