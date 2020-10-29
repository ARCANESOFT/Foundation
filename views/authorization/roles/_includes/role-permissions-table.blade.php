<?php /** @var  Arcanesoft\Foundation\Authorization\Models\Role  $role */ ?>

@if($role->permissions->isNotEmpty())
    <x-arc:card-table class="table-hover">
        <thead>
            <tr>
                <x-arc:table-th label="Group"/>
                <x-arc:table-th label="Category"/>
                <x-arc:table-th label="Name"/>
                <x-arc:table-th label="Description"/>
                <x-arc:table-th label="Actions" class="text-right"/>
            </tr>
        </thead>
        <tbody>
            @foreach($role->permissions as $permission)
            <tr>
                <td class="small">{{ $permission->group->name }}</td>
                <td class="small">{{ $permission->category }}</td>
                <td class="small">{{ $permission->name }}</td>
                <td class="small">{{ $permission->description }}</td>
                <td class="text-right">
                    {{-- SHOW --}}
                    <x-arc:datatable-action
                        type="show"
                        action="{{ route('admin::authorization.permissions.show', [$permission]) }}"
                        allowed="{{ Arcanesoft\Foundation\Authorization\Policies\PermissionsPolicy::can('show', [$permission]) }}"/>

                    {{-- DETACH --}}
                    <x-arc:datatable-action
                        type="detach"
                        action="ARCANESOFT.emit('authorization::roles.permissions.detach', {id: '{{ $permission->getRouteKey() }}'})"
                        allowed="{{ Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::can('permissions.detach', [$role, $permission]) }}"/>
                </td>
            </tr>
            @endforeach
        </tbody>
    </x-arc:card-table>

    {{-- DETACH MODAL/SCRIPT --}}
    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('permissions.detach'), [$role])
        @push('modals')
            <x-arc:modal-action
                type="detach"
                id="detach-permission"
                action="{{ route('admin::authorization.roles.permissions.detach', [$role, ':id']) }}" method="DELETE"
                title="Detach Permission"
                body="Are you sure you want to detach this permission ?"
            />
        @endpush

        @push('scripts')
            <script defer>
                let detachPermissionModal  = components.modal('div#detach-permission-modal')
                let detachPermissionForm   = components.form('form#detach-permission-form')
                let detachPermissionAction = detachPermissionForm.getAction()

                ARCANESOFT.on('authorization::roles.permissions.detach', ({id}) => {
                    detachPermissionModal.show()
                    detachPermissionForm.action(detachPermissionAction.replace(':id', id))
                })

                detachPermissionForm.onSubmit('DELETE', () => {
                    detachPermissionModal.hide()
                    location.reload()
                })

                detachPermissionModal.on('hidden', () => {
                    detachPermissionForm.action(detachPermissionAction)
                })
            </script>
        @endpush
    @endcan
@else
    @include('foundation::_partials.no-data-found')
@endif


