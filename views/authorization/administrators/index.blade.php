@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-administrator-secret"></i> @lang('Administrators')
@endsection

@push('content-nav')
    <div class="mt-2 mb-3 text-right">
        @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('metrics'))
        <a href="{{ route('admin::auth.administrators.metrics') }}" class="btn btn-sm btn-secondary {{ active(['admin::auth.administrators.metrics']) }}">@lang('Metrics')</a>
        @endcan

        @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('index'))
        <div class="btn-group ml-1" role="group" aria-label="Administrators lists">
            <a href="{{ route('admin::auth.administrators.index') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::auth.administrators.index']) }}">@lang('All')</a>
            <a href="{{ route('admin::auth.administrators.trash') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::auth.administrators.trash']) }}">@lang('Trash')</a>
        </div>
        @endcan

        @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('create'))
        {{ arcanesoft\ui\action_link('add', route('admin::auth.administrators.create'))->size('sm')->pushClass('ml-1') }}
        @endcan
    </div>
@endpush

@section('content')
    <v-datatable
        name="{{ Arcanesoft\Foundation\Auth\Views\Components\AdministratorsDatatable::NAME }}"
        :data='@json(compact('trash'))'></v-datatable>
@endsection


{{-- ACIVATE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('activate'))
    @push('modals')
        <x-arc:modal id="activate-modal" aria-labelledby="activate-modal-title" data-backdrop="static">
            <x-arc:form action="{{ route('admin::auth.administrators.activate', [':id']) }}" method="PUT" id="activate-form">
                <x-arc:modal-header>
                    <x-arc:modal-title id="activate-modal-title"/>
                </x-arc:modal-header>
                <x-arc:modal-body id="activate-modal-message">
                </x-arc:modal-body>
                <x-arc:modal-footer class="justify-content-between">
                    <x-arc:modal-cancel-button/>
                    <x-arc:modal-action-button type="activate" id="activate-btn"/>
                    <x-arc:modal-action-button type="deactivate" id="deactivate-btn"/>
                </x-arc:modal-footer>
            </x-arc:form>
        </x-arc:modal>
    @endpush

    @push('scripts')
        <script>
            let activateModal = components.modal('div#activate-modal')
            let activateForm = components.form('form#activate-form', {
                submitBtnSelector: 'button[type="submit"]:not([style*="display: none"])'
            })
            let activateAction = activateForm.action()

            ARCANESOFT.on('authorization::administrators.activate', ({id, status}) => {
                activateForm.action(activateAction.replace(':id', id))

                const modal = activateModal.elt()

                let modalTitle    = modal.querySelector('#activate-modal-title')
                let modalMessage  = modal.querySelector('#activate-modal-message')
                let activateBtn   = modal.querySelector('button#activate-btn')
                let deactivateBtn = modal.querySelector('button#deactivate-btn')

                if (status === 'activated') {
                    modalTitle.innerHTML = "@lang('Deactivate Administrator')"
                    modalMessage.innerHTML = "@lang('Are you sure you want to deactivate this administrator ?')"
                    activateBtn.style.display = 'none'
                    deactivateBtn.style.display = ''
                }
                else {
                    modalTitle.innerHTML = "@lang('Activate Administrator')"
                    modalMessage.innerHTML = "@lang('Are you sure you want to activate this administrator ?')"
                    activateBtn.style.display = ''
                    deactivateBtn.style.display = 'none'
                }

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

{{-- DELETE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('delete'))
    @push('modals')
        <x-arc:modal-action
            type="delete"
            action="{{ route('admin::auth.administrators.delete', [':id']) }}" method="DELETE"
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
@can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('restore'))
    @push('modals')
        <x-arc:modal-action
            type="restore"
            action="{{ route('admin::auth.administrators.restore', [':id']) }}" method="PUT"
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

