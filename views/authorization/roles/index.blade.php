<x-arc:layout>
    @section('page-title')
        <i class="fa fa-fw fa-user-tag"></i> @lang('Roles')
    @endsection

    @push('content-nav')
        @include('foundation::authorization.roles._partials.nav-actions')
    @endpush

    <v-datatable
        name="roles-datatable"
        url="{{ route('admin::authorization.roles.datatable') }}"/>

    @push('scripts')
        <script>
            const rolesDatatable = components.datatable('roles-datatable')
        </script>
    @endpush

    {{-- ACIVATE MODAL/SCRIPT --}}
    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('activate'))
        @push('modals')
            <x-arc:modal-action
                type="activate"
                action="{{ route('admin::authorization.roles.activate', [':id']) }}" method="PUT"
                title="Activate Role"
                body="Are you sure you want to activate this role ?"
            />
        @endpush

        @push('scripts')
            <script>
                let activateModal  = components.modal('div#activate-modal')
                let activateForm   = components.form('form#activate-form')
                let activateAction = activateForm.action()

                ARCANESOFT.on('authorization::roles.activate', ({id}) => {
                    activateForm.action(activateAction.replace(':id', id))
                    activateModal.show()
                })

                activateForm.onSubmit('PUT', () => {
                    activateModal.hide()
                    rolesDatatable.reload()
                })

                activateModal.on('hidden', () => {
                    activateForm.action(activateAction.toString())
                })
            </script>
        @endpush
    @endcan

    {{-- DEACIVATE MODAL/SCRIPT --}}
    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('deactivate'))
        @push('modals')
            <x-arc:modal-action
                type="deactivate"
                action="{{ route('admin::authorization.roles.deactivate', [':id']) }}" method="PUT"
                title="Deactivate Role"
                body="Are you sure you want to deactivate this role ?"
            />
        @endpush

        @push('scripts')
            <script>
                let deactivateModal  = components.modal('div#deactivate-modal')
                let deactivateForm   = components.form('form#deactivate-form')
                let deactivateAction = deactivateForm.action()

                ARCANESOFT.on('authorization::roles.deactivate', ({id, status}) => {
                    deactivateForm.action(deactivateAction.replace(':id', id))
                    deactivateModal.show()
                })

                deactivateForm.onSubmit('PUT', () => {
                    deactivateModal.hide()
                    rolesDatatable.reload()
                })

                deactivateModal.on('hidden', () => {
                    deactivateForm.action(deactivateAction.toString())
                })
            </script>
        @endpush
    @endcan

    {{-- DELETE MODAL/SCRIPT --}}
    @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('delete'))
        @push('modals')
            <x-arc:modal-action
                type="delete"
                action="{{ route('admin::authorization.roles.delete', [':id']) }}" method="DELETE"
                title="Delete Role"
                body="Are you sure you want to delete this role ?"
            />
        @endpush

        @push('scripts')
            <script>
                let deleteModal  = components.modal('div#delete-modal')
                let deleteForm   = components.form('form#delete-form')
                let deleteAction = deleteForm.action()

                ARCANESOFT.on('authorization::roles.delete', ({id}) => {
                    deleteForm.action(deleteAction.replace(':id', id))
                    deleteModal.show()
                })

                deleteForm.onSubmit('DELETE', () => {
                    deleteModal.hide()
                    rolesDatatable.reload()
                })

                deleteModal.on('hidden', () => {
                    deleteForm.action(deleteAction.toString())
                })
            </script>
        @endpush
    @endcan
</x-arc:layout>
