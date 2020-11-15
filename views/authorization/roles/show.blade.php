@extends(arcanesoft\foundation()->template())

<?php
/**
 * @var  Arcanesoft\Foundation\Authorization\Models\Role  $role
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
            <x-arc:card>
                <x-arc:card-header>@lang('Role')</x-arc:card-header>
                <x-arc:card-table>
                    <tbody>
                        <tr>
                            <x-arc:table-th label="Name"/>
                            <td class="text-right small">{{ $role->name }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Description"/>
                            <td class="text-right small">{{ $role->description }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Administrator"/>
                            <td class="text-right">
                                <x-arc:badge-count value="{{ $role->administrators->count() }}"/>
                            </td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Permissions"/>
                            <td class="text-right">
                                <x-arc:badge-count value="{{ $role->permissions->count() }}"/>
                            </td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Locked"/>
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
                            <x-arc:table-th label="Status"/>
                            <td class="text-right">
                                <x-arc:badge-active value="{{ $role->isActive() }}"/>
                            </td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Created at"/>
                            <td class="text-muted text-right small">{{ $role->created_at }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Updated at"/>
                            <td class="text-muted text-right small">{{ $role->updated_at }}</td>
                        </tr>
                    </tbody>
                </x-arc:card-table>
                <x-arc:card-footer class="d-flex justify-content-end">
                    {{-- UPDATE --}}
                    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('update'), [$role])
                        <a href="{{ route('admin::authorization.roles.edit', [$role]) }}"
                           class="btn btn-sm btn-secondary">@lang('Edit')</a>
                    @endcan

                    {{-- ACTIVATE --}}
                    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('activate'), [$role])
                        <button class="btn btn-sm btn-secondary ml-2"
                                onclick="ARCANESOFT.emit('authorization::roles.activate')">@lang('Activate')</button>
                    @endcan

                    {{-- DEACTIVATE --}}
                    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('deactivate'), [$role])
                        <button class="btn btn-sm btn-secondary ml-2"
                                onclick="ARCANESOFT.emit('authorization::roles.deactivate')">@lang('Deactivate')</button>
                    @endcan

                    {{-- DELETE --}}
                    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('delete'), [$role])
                        <button class="btn btn-sm btn-danger ml-2"
                                onclick="ARCANESOFT.emit('authorization::roles.delete')">@lang('Delete')</button>
                    @endcan
                </x-arc:card-footer>
            </x-arc:card>
        </div>
        <div class="col-lg-8">
            <x-arc:card>
                <x-arc:card-header class="d-flex justify-content-end">
                    <div class="btn-group" role="group" aria-label="Administrators and Permissions">
                        <a href="{{ route('admin::authorization.roles.show', [$role]) }}" class="btn btn-sm btn-secondary {{ $tab === 'administrators' ? 'active' : '' }}">@lang('Administrators')</a>
                        <a href="{{ route('admin::authorization.roles.show', [$role, 'tab' => 'permissions']) }}" class="btn btn-sm btn-secondary {{ $tab === 'permissions' ? 'active' : '' }}">@lang('Permissions')</a>
                    </div>
                </x-arc:card-header>
                @includeWhen($tab === 'administrators', 'foundation::authorization.roles._includes.role-administrators-table', ['role' => $role])
                @includeWhen($tab === 'permissions', 'foundation::authorization.roles._includes.role-permissions-table', ['role' => $role])
            </x-arc:card>
        </div>
    </div>
@endsection

{{-- ACIVATE MODAL --}}
@can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('activate'), [$role])
    @push('modals')
        <x-arc:modal-action
            type="activate"
            action="{{ route('admin::authorization.roles.activate', [$role]) }}" method="PUT"
            title="Activate Role" body="Are you sure you want to activate this role ?"
        />
    @endpush

    @push('scripts')
        <script defer>
            let activateModal = components.modal('div#activate-modal')
            let activateForm  = components.form('form#activate-form')

            ARCANESOFT.on('authorization::roles.activate', () => {
                activateModal.show()
            });

            activateForm.onSubmit('PUT', () => {
                activateModal.hide()
                location.reload()
            })
        </script>
    @endpush
@endcan

{{-- DEACIVATE MODAL --}}
@can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('deactivate'), [$role])
    @push('modals')
        <x-arc:modal-action
            type="deactivate"
            action="{{ route('admin::authorization.roles.deactivate', [$role]) }}" method="PUT"
            title="Deactivate Role" body="Are you sure you want to deactivate this role ?"
        />
    @endpush

    @push('scripts')
        <script defer>
            let deactivateModal = components.modal('div#deactivate-modal')
            let deactivateForm  = components.form('form#deactivate-form')

            ARCANESOFT.on('authorization::roles.deactivate', () => {
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
@can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('delete'), [$role])
    @push('modals')
        <x-arc:modal-action
            type="delete"
            action="{{ route('admin::authorization.roles.delete', [$role]) }}" method="DELETE"
            title="Delete Role"
            body="Are you sure you want to delete this role ?"
        />
    @endpush

    @push('scripts')
        <script defer>
            let deleteModal = components.modal('div#delete-modal')
            let deleteForm  = components.form('form#delete-form')

            ARCANESOFT.on('authorization::roles.delete', () => {
                deleteModal.show()
            })

            deleteForm.onSubmit('DELETE', () => {
                deleteModal.hide()
                location.replace("{{ route('admin::authorization.roles.index') }}")
            })
        </script>
    @endpush
@endcan
