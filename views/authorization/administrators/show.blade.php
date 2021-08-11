<?php /** @var  Arcanesoft\Foundation\Authorization\Models\Administrator  $administrator */ ?>
<x-arc:layout>
    @section('page-title')
        <i class="fa fa-fw fa-user-secret"></i> @lang('Administrators') <small>@lang("Administrator's details")</small>
    @endsection

    <div class="row g-4">
        <div class="col-lg-5">
            {{-- ADMINISTRATOR --}}
            <x-arc:card>
                <x-arc:card-body class="d-flex justify-content-center">
                    <div class="avatar avatar-xxl rounded-circle bg-light">
                        <img src="{{ $administrator->avatar }}" alt="{{ $administrator->full_name }}">
                    </div>
                </x-arc:card-body>
                <x-arc:card-table hover>
                    <tbody>
                    <tr>
                        <x-arc:table-th label="Full Name"/>
                        <td class="text-end">{{ $administrator->full_name }}</td>
                    </tr>
                    <tr>
                        <x-arc:table-th label="Email"/>
                        <td class="small text-end">
                            {{ $administrator->email }}
                            @if ($administrator->hasVerifiedEmail())
                                <i class="far fa-check-circle text-primary"
                                   data-toggle="tooltip" title="@lang('Verified')"></i>
                            @endif
                        </td>
                    </tr>
                    @if ($administrator->hasVerifiedEmail())
                        <tr>
                            <x-arc:table-th label="Email Verified at"/>
                            <td class="text-end">
                                <small class="text-muted">{{ $administrator->email_verified_at }}</small>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <x-arc:table-th label="Status"/>
                        <td class="text-end">
                            <x-arc:badge-active :value="$administrator->isActive()"/>
                            @if ($administrator->isSuperAdmin())
                                <span class="badge border border-warning text-muted ms-1"
                                      data-toggle="tooltip" data-placement="top" title="@lang('Super Administrator')">
                                    <i class="fas fa-crown"></i>
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <x-arc:table-th label="Last Activity"/>
                        <td class="text-end"><small class="text-muted">{{ $administrator->last_activity }}</small></td>
                    </tr>
                    <tr>
                        <x-arc:table-th label="Created at"/>
                        <td class="text-end"><small class="text-muted">{{ $administrator->created_at }}</small></td>
                    </tr>
                    <tr>
                        <x-arc:table-th label="Updated at"/>
                        <td class="text-end"><small class="text-muted">{{ $administrator->updated_at }}</small></td>
                    </tr>
                    @if ($administrator->trashed())
                        <tr>
                            <x-arc:table-th label="Deleted at"/>
                            <td class="text-end"><small class="text-muted">{{ $administrator->deleted_at }}</small></td>
                        </tr>
                    @endif
                    </tbody>
                </x-arc:card-table>
                @if(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::canAny(['update', 'activate', 'deactivate', 'restore', 'delete'], [$administrator]))
                    <x-arc:card-footer actions>
                        {{-- UPDATE --}}
                        @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('update'), [$administrator])
                            <x-arc:button-action
                                type="edit" action="{{ route('admin::authorization.administrators.edit', [$administrator]) }}"/>
                        @endcan

                        {{-- ACTIVATE --}}
                        @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('activate'), [$administrator])
                            <x-arc:button-action
                                type="activate" action="authorization::administrators.activate"/>
                        @endcan

                        {{-- DEACTIVATE --}}
                        @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('deactivate'), [$administrator])
                            <x-arc:button-action
                                type="deactivate" action="authorization::administrators.deactivate"/>
                        @endcan

                        {{-- RESTORE --}}
                        @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('restore'), [$administrator])
                            <x-arc:button-action
                                type="restore" action="authorization::administrators.restore"/>
                        @endcan

                        {{-- DELETE --}}
                        @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('delete'), [$administrator])
                            <x-arc:button-action
                                type="delete" action="authorization::administrators.delete"/>
                        @endcan
                    </x-arc:card-footer>
                @endif
            </x-arc:card>
        </div>

        <div class="col-lg-7">
            <div class="row row-cols-1 g-4">
                {{-- ROLES --}}
                <div class="col">
                    <x-arc:card>
                        <x-arc:card-header>@lang('Roles')</x-arc:card-header>
                        <x-arc:card-table hover>
                            <thead>
                            <tr>
                                <x-arc:table-th label="Name"/>
                                <x-arc:table-th label="Description"/>
                                <x-arc:table-th label="Actions" class="text-end"/>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($administrator->roles as $role)
                                <?php /** @var  Arcanesoft\Foundation\Authorization\Models\Role  $role */ ?>
                                <tr>
                                    <td class="small">{{ $role->name }}</td>
                                    <td class="small">{{ $role->description }}</td>
                                    <td class="text-end">
                                        <x-arc:table-action
                                            type="Show" action="{{ route('admin::authorization.roles.show', [$role]) }}"/>
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
                        <x-arc:card-table hover>
                            <thead>
                            <tr>
                                <x-arc:table-th />
                                <x-arc:table-th label="IP"/>
                                <x-arc:table-th label="Device"/>
                                <x-arc:table-th label="Last activity"/>
                                <x-arc:table-th label="Actions" class="text-end"/>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($administrator->sessions as $session)
                                <tr>
                                    <td>
                                        {{ $session->device_icon }}
                                        @if ($session->isCurrent())
                                            <span class="status bg-success status-animated ms-1"
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

    {{-- ACIVATE MODAL --}}
    @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('activate'), [$administrator])
        @push('modals')
            <x-arc:modal-action
                type="activate"
                action="{{ route('admin::authorization.administrators.activate', [$administrator]) }}" method="PUT"
                title="Activate Administrator" body="Are you sure you want to activate this administrator ?"
            />
        @endpush

        @push('scripts')
            <script defer>
                let activateModal = components.modal('div#activate-modal')
                let activateForm  = components.form('form#activate-form')

                ARCANESOFT.on('authorization::administrators.activate', () => {
                    activateModal.show()
                })

                activateForm.onSubmit('PUT', () => {
                    activateModal.hide()
                    location.reload()
                })
            </script>
        @endpush
    @endcan

    {{-- DEACIVATE MODAL --}}
    @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('deactivate'), [$administrator])
        @push('modals')
            <x-arc:modal-action
                type="deactivate"
                action="{{ route('admin::authorization.administrators.deactivate', [$administrator]) }}" method="PUT"
                title="Deactivate Administrator" body="Are you sure you want to deactivate this administrator ?"
            />
        @endpush

        @push('scripts')
            <script defer>
                let deactivateModal = components.modal('div#deactivate-modal')
                let deactivateForm  = components.form('form#deactivate-form')

                ARCANESOFT.on('authorization::administrators.deactivate', () => {
                    deactivateModal.show()
                })

                deactivateForm.onSubmit('PUT', () => {
                    deactivateModal.hide()
                    location.reload()
                })
            </script>
        @endpush
    @endcan

    {{-- DELETE MODAL --}}
    @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('delete'), [$administrator])
        @push('modals')
            <x-arc:modal-action
                type="delete"
                action="{{ route('admin::authorization.administrators.delete', [$administrator]) }}" method="DELETE"
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
                    location.replace("{{ route('admin::authorization.administrators.index') }}")
                    @else
                    location.reload()
                    @endif
                })
            </script>
        @endpush
    @endcan

    {{-- RESTORE MODAL --}}
    @if($administrator->trashed())
        @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('restore'), [$administrator])
            @push('modals')
                <x-arc:modal-action
                    type="restore"
                    action="{{ route('admin::authorization.administrators.restore', [$administrator]) }}" method="PUT"
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
                    })

                    restoreForm.onSubmit('PUT', () => {
                        restoreModal.hide()
                        location.reload()
                    })
                </script>
            @endpush
        @endcan
    @endif
</x-arc:layout>
