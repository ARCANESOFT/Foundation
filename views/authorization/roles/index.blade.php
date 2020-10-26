@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-user-tag"></i> @lang('Roles')
@endsection

@push('content-nav')
    <div class="mb-3 text-right">
        @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('metrics'))
            <a href="{{ route('admin::auth.roles.metrics') }}" class="btn btn-sm btn-secondary {{ active(['admin::auth.roles.metrics']) }}">@lang('Metrics')</a>
        @endcan

        @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('create'))
            <a href="{{ route('admin::auth.roles.create') }}" class="btn btn-primary btn-sm ml-1">
                <i class="fa fa-fw fa-plus"></i> @lang('Add')
            </a>
        @endcan
    </div>
@endpush

@section('content')
    <v-datatable name="{{ Arcanesoft\Foundation\Auth\Views\Components\RolesDatatable::NAME }}"></v-datatable>
@endsection

{{-- ACIVATE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('activate'))
    @push('modals')
        <x-arc:modal-action
            type="activate"
            action="{{ route('admin::auth.roles.activate', [':id']) }}" method="PUT"
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
                location.reload()
            })

            activateModal.on('hidden', () => {
                activateForm.action(activateAction.toString())
            })
        </script>
    @endpush
@endcan

{{-- DEACIVATE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('deactivate'))
    @push('modals')
        <x-arc:modal-action
            type="deactivate"
            action="{{ route('admin::auth.roles.deactivate', [':id']) }}" method="PUT"
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
                location.reload()
            })

            deactivateModal.on('hidden', () => {
                deactivateForm.action(deactivateAction.toString())
            })
        </script>
    @endpush
@endcan

{{-- DELETE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('delete'))
    @push('modals')
        <x-arc:modal-action
            type="delete"
            action="{{ route('admin::auth.roles.delete', [':id']) }}" method="DELETE"
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
                location.reload()
            })

            deleteModal.on('hidden', () => {
                deleteForm.action(deleteAction.toString())
            })
        </script>
    @endpush
@endcan
