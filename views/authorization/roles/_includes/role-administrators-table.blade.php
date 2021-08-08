<?php /** @var  Arcanesoft\Foundation\Authorization\Models\Role  $role */ ?>

@if($role->administrators->isNotEmpty())
    <table id="administrators-table" class="table table-borderless table-hover mb-0">
        <thead>
            <tr>
                <x-arc:table-th/>
                <x-arc:table-th label="Full Name"/>
                <x-arc:table-th label="Email"/>
                <x-arc:table-th label="Created at" class="text-center"/>
                <x-arc:table-th label="Status" class="text-center"/>
                <x-arc:table-th label="Actions" class="text-end"/>
            </tr>
        </thead>
        <tbody>
            @foreach($role->administrators as $administrator)
            <tr>
                <td>
                    <div class="avatar avatar-sm rounded-circle bg-light">
                        <img src="{{ $administrator->avatar }}" alt="{{ $administrator->full_name }}">
                    </div>
                </td>
                <td class="small">{{ $administrator->full_name }}</td>
                <td class="small">{{ $administrator->email }}</td>
                <td class="small text-center">{{ $administrator->created_at }}</td>
                <td class="text-center">
                    <span class="status {{ $administrator->isActive() ? 'bg-success' : 'bg-secondary' }}"
                          data-toggle="tooltip" title="@lang($administrator->isActive() ? 'Activated' : 'Deactivated')"></span>
                </td>
                <td class="text-end">
                    {{-- SHOW --}}
                    @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('show'), [$administrator])
                        <x-arc:table-action
                            type="show"
                            action="{{ route('admin::authorization.administrators.show', [$administrator]) }}"/>
                    @endcan

                    {{-- DETACH --}}
                    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('administrators.detach'), [$role, $administrator])
                        <x-arc:table-action
                            type="detach"
                            action="authorization::roles.administrators.detach"
                            :params="['id' => $administrator->getRouteKey()]"/>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- DETACH MODAL/SCRIPT --}}
    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('users.detach'), [$role])
        @push('modals')
            <x-arc:modal-action
                type="detach"
                id="detach-administrator"
                action="{{ route('admin::authorization.roles.administrators.detach', [$role, ':id']) }}" method="DELETE"
                title="Detach Administrator"
                body="Are you sure you want to detach this administrator ?"
            />
        @endpush

        @push('scripts')
            <script defer>
                let detachAdministratorModal  = components.modal('div#detach-administrator-modal')
                let detachAdministratorForm   = components.form('form#detach-administrator-form')
                let detachAdministratorAction = detachAdministratorForm.getAction()

                ARCANESOFT.on('authorization::roles.administrators.detach', ({id}) => {
                    detachAdministratorModal.show()
                    detachAdministratorForm.action(detachAdministratorAction.replace(':id', id))
                })

                detachAdministratorForm.onSubmit('DELETE', () => {
                    detachAdministratorModal.hide()
                    location.reload()
                })

                detachAdministratorModal.on('hidden', () => {
                    detachAdministratorForm.action(detachAdministratorAction)
                })
            </script>
        @endpush
    @endcan
@else
    @include('foundation::_partials.states.no-data-found')
@endif
