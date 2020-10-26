@extends(arcanesoft\foundation()->template())

<?php /** @var  bool  $trash */ ?>

@section('page-title')
    <i class="fa fa-fw fa-users"></i> @lang('Users')
@endsection

@push('content-nav')
    <div class="mt-2 mb-3 text-right">
        @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('metrics'))
        <a href="{{ route('admin::auth.users.metrics') }}"
           class="btn btn-sm btn-secondary {{ active(['admin::auth.users.metrics']) }}">@lang('Metrics')</a>
        @endcan

        @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('index'))
        <div class="btn-group ml-auto" role="group" aria-label="@lang("Users's List")">
            <a href="{{ route('admin::auth.users.index') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::auth.users.index']) }}">@lang('All')</a>
            <a href="{{ route('admin::auth.users.trash') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::auth.users.trash']) }}">@lang('Trash')</a>
        </div>
        @endcan

        @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('create'))
            <a href="{{ route('admin::auth.users.create') }}" class="btn btn-primary btn-sm ml-1">
                <i class="fa fa-fw fa-plus"></i> @lang('Add')
            </a>
        @endcan
    </div>
@endpush

@section('content')
    <v-datatable
        name="{{ Arcanesoft\Foundation\Auth\Views\Components\UsersDatatable::NAME }}"
        :data='@json(compact('trash'))'/>
@endsection

{{-- ACIVATE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('activate'))
    @push('modals')
        <x-arc:modal-action
            type="activate"
            action="{{ route('admin::auth.users.activate', [':id']) }}" method="PUT"
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
                location.reload()
            })

            activateModal.on('hidden', () => {
                activateForm.action(activateAction.toString())
            })
        </script>
    @endpush
@endcan

{{-- DEACIVATE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('deactivate'))
    @push('modals')
        <x-arc:modal-action
            type="deactivate"
            action="{{ route('admin::auth.users.deactivate', [':id']) }}" method="PUT"
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
                location.reload()
            })

            deactivateModal.on('hidden', () => {
                deactivateForm.action(deactivateAction.toString())
            })
        </script>
    @endpush
@endcan

{{-- DELETE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('delete'))
    @push('modals')
        <x-arc:modal-action
            type="delete"
            action="{{ route('admin::auth.users.delete', [':id']) }}" method="DELETE"
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
                location.reload()
            })

            deleteModal.on('hidden', () => {
                deleteForm.action(deleteAction.toString())
            })
        </script>
    @endpush
@endcan

{{-- RESTORE MODAL/SCRIPT --}}
@if ($trash)
    @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('restore'))
        @push('modals')
            <x-arc:modal-action
                type="restore"
                action="{{ route('admin::auth.users.restore', [':id']) }}" method="PUT"
                title="Restore User"
                body="Are you sure you want to restore this user ?"
            />
        @endpush

        @push('scripts')
            <script defer>
                let restoreModal = components.modal('div#restore-user-modal')
                let restoreForm = components.form('form#restore-user-form')
                let restoreAction = restoreForm.action()

                ARCANESOFT.on('authorization::users.restore', ({id}) => {
                    restoreForm.action(restoreAction.replace(':id', id))
                    restoreModal.show()
                })

                restoreForm.onSubmit('PUT', () => {
                    restoreModal.hide()
                    location.reload()
                })

                restoreModal.on('hidden', () => {
                    restoreForm.action(restoreAction.toString())
                })
            </script>
        @endpush
    @endcan
@endif
