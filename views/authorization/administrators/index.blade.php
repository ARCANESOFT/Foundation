@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-user-secret"></i> @lang('Administrators')
@endsection

@push('content-nav')
    <div class="mt-2 mb-3 text-right">
        @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('metrics'))
            <a href="{{ route('admin::authorization.administrators.metrics') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::authorization.administrators.metrics']) }}">@lang('Metrics')</a>
        @endcan

        @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('index'))
        <div class="btn-group ml-1" role="group" aria-label="Administrators lists">
            <a href="{{ route('admin::authorization.administrators.index') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::authorization.administrators.index']) }}">@lang('All')</a>
            <a href="{{ route('admin::authorization.administrators.trash') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::authorization.administrators.trash']) }}">@lang('Trash')</a>
        </div>
        @endcan

        @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('create'))
            <a href="{{ route('admin::authorization.administrators.create') }}" class="btn btn-primary btn-sm ml-1">
                <i class="fa fa-fw fa-plus"></i> @lang('Add')
            </a>
        @endcan
    </div>
@endpush

@section('content')
    <v-datatable
        name="{{ Arcanesoft\Foundation\Authorization\Views\Components\AdministratorsDatatable::NAME }}"
        :data='@json(compact('trash'))'></v-datatable>
@endsection


{{-- ACIVATE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('activate'))
    @push('modals')
        <x-arc:modal-action
            type="activate"
            action="{{ route('admin::authorization.administrators.activate', [':id']) }}" method="PUT"
            title="Activate Administrator"
            body="Are you sure you want to activate this administrator ?"
        />
    @endpush

    @push('scripts')
        <script>
            let activateModal  = components.modal('div#activate-modal')
            let activateForm   = components.form('form#activate-form')
            let activateAction = activateForm.action()

            ARCANESOFT.on('authorization::administrators.activate', ({id}) => {
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
@can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('deactivate'))
    @push('modals')
        <x-arc:modal-action
            type="deactivate"
            action="{{ route('admin::authorization.administrators.deactivate', [':id']) }}" method="PUT"
            title="Deactivate Administrator"
            body="Are you sure you want to deactivate this administrator ?"
        />
    @endpush

    @push('scripts')
        <script>
            let deactivateModal  = components.modal('div#deactivate-modal')
            let deactivateForm   = components.form('form#deactivate-form')
            let deactivateAction = deactivateForm.action()

            ARCANESOFT.on('authorization::administrators.deactivate', ({id, status}) => {
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
@can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('delete'))
    @push('modals')
        <x-arc:modal-action
            type="delete"
            action="{{ route('admin::authorization.administrators.delete', [':id']) }}" method="DELETE"
            title="Delete Administrator"
            body="Are you sure you want to delete this administrator ?"
        />
    @endpush

    @push('scripts')
        <script>
            let deleteModal  = components.modal('div#delete-modal')
            let deleteForm   = components.form('form#delete-form')
            let deleteAction = deleteForm.action()

            ARCANESOFT.on('authorization::administrators.delete', ({id}) => {
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
@can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('restore'))
    @push('modals')
        <x-arc:modal-action
            type="restore"
            action="{{ route('admin::authorization.administrators.restore', [':id']) }}" method="PUT"
            title="Restore Administrator"
            body="Are you sure you want to restore this administrator ?"
        />
    @endpush

    @push('scripts')
        <script defer>
            let restoreModal = components.modal('div#restore-administrator-modal')
            let restoreForm = components.form('form#restore-administrator-form')
            let restoreAction = restoreForm.action()

            ARCANESOFT.on('authorization::administrators.restore', ({id}) => {
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
