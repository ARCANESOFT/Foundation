@extends(arcanesoft\foundation()->template())

<?php /** @var  bool  $trash */ ?>

@section('page-title')
    <i class="fa fa-fw fa-users"></i> @lang('Users')
@endsection

@push('content-nav')
    <nav class="page-actions">
        @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('metrics'))
            <a href="{{ route('admin::authorization.users.metrics') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::authorization.users.metrics']) }}">@lang('Metrics')</a>
        @endcan

        @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('index'))
            <a href="{{ route('admin::authorization.users.index') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::authorization.users.index']) }}">@lang('List')</a>
        @endcan

        @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('create'))
            <a href="{{ route('admin::authorization.users.create') }}"
               class="btn btn-primary btn-sm"><i class="fa fa-fw fa-plus"></i> @lang('Add')</a>
        @endcan
    </nav>
@endpush

@section('content')
    <v-datatable
        name="users-datatable"
        url="{{ route('admin::authorization.users.datatable') }}"/>
@endsection

@push('scripts')
    <script>
        const usersDatatable = components.datatable('users-datatable')
    </script>
@endpush

{{-- ACIVATE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('activate'))
    @push('modals')
        <x-arc:modal-action
            type="activate"
            action="{{ route('admin::authorization.users.activate', [':id']) }}" method="PUT"
            title="Activate User"
            body="Are you sure you want to activate this user ?"
        />
    @endpush

    @push('scripts')
        <script>
            let activateModal  = components.modal('div#activate-modal')
            let activateForm   = components.form('form#activate-form')
            let activateAction = activateForm.action()

            ARCANESOFT.on('authorization::users.activate', ({id}) => {
                activateForm.action(activateAction.replace(':id', id))
                activateModal.show()
            })

            activateForm.onSubmit('PUT', () => {
                activateModal.hide()
                usersDatatable.reload()
            })

            activateModal.on('hidden', () => {
                activateForm.action(activateAction.toString())
            })
        </script>
    @endpush
@endcan

{{-- DEACIVATE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('deactivate'))
    @push('modals')
        <x-arc:modal-action
            type="deactivate"
            action="{{ route('admin::authorization.users.deactivate', [':id']) }}" method="PUT"
            title="Deactivate User"
            body="Are you sure you want to deactivate this user ?"
        />
    @endpush

    @push('scripts')
        <script>
            let deactivateModal  = components.modal('div#deactivate-modal')
            let deactivateForm   = components.form('form#deactivate-form')
            let deactivateAction = deactivateForm.action()

            ARCANESOFT.on('authorization::users.deactivate', ({id, status}) => {
                deactivateForm.action(deactivateAction.replace(':id', id))
                deactivateModal.show()
            })

            deactivateForm.onSubmit('PUT', () => {
                deactivateModal.hide()
                usersDatatable.reload()
            })

            deactivateModal.on('hidden', () => {
                deactivateForm.action(deactivateAction.toString())
            })
        </script>
    @endpush
@endcan

{{-- DELETE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('delete'))
    @push('modals')
        <x-arc:modal-action
            type="delete"
            action="{{ route('admin::authorization.users.delete', [':id']) }}" method="DELETE"
            title="Delete User"
            body="Are you sure you want to delete this user ?"
        />
    @endpush

    @push('scripts')
        <script>
            let deleteModal  = components.modal('div#delete-modal')
            let deleteForm   = components.form('form#delete-form')
            let deleteAction = deleteForm.action()

            ARCANESOFT.on('authorization::users.delete', ({id}) => {
                deleteForm.action(deleteAction.replace(':id', id))
                deleteModal.show()
            })

            deleteForm.onSubmit('DELETE', () => {
                deleteModal.hide()
                usersDatatable.reload()
            })

            deleteModal.on('hidden', () => {
                deleteForm.action(deleteAction.toString())
            })
        </script>
    @endpush
@endcan

{{-- RESTORE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('restore'))
    @push('modals')
        <x-arc:modal-action
            type="restore"
            action="{{ route('admin::authorization.users.restore', [':id']) }}" method="PUT"
            title="Restore User"
            body="Are you sure you want to restore this user ?"
        />
    @endpush

    @push('scripts')
        <script defer>
            let restoreModal = components.modal('div#restore-modal')
            let restoreForm = components.form('form#restore-form')
            let restoreAction = restoreForm.action()

            ARCANESOFT.on('authorization::users.restore', ({id}) => {
                restoreForm.action(restoreAction.replace(':id', id))
                restoreModal.show()
            })

            restoreForm.onSubmit('PUT', () => {
                restoreModal.hide()
                usersDatatable.reload()
            })

            restoreModal.on('hidden', () => {
                restoreForm.action(restoreAction.toString())
            })
        </script>
    @endpush
@endcan
