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
        {{ arcanesoft\ui\action_link('add', route('admin::auth.users.create'))->size('sm') }}
        @endcan
    </div>
@endpush

@section('content')
    <v-datatable
        name="{{ Arcanesoft\Foundation\Auth\Views\Components\UsersDatatable::NAME }}"
        :trash="{{ $trash ? 'true' : 'false' }}"/>
@endsection

{{-- ACTIVATE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('activate'))
    @push('modals')
        <x-arc:modal id="activate-user-modal" aria-labelledby="activate-user-modal-title" data-backdrop="static">
            <x-arc:form action="{{ route('admin::auth.users.activate', [':id']) }}" method="PUT" id="activate-user-form">
                <x-arc:modal-header>
                    <x-arc:modal-title id="activate-user-modal-title"/>
                </x-arc:modal-header>
                <x-arc:modal-body id="activate-user-modal-message"/>
                <x-arc:modal-footer class="justify-content-between">
                    <x-arc:modal-cancel-button/>
                    {{ arcanesoft\ui\action_button('activate')->id('activate-user-btn')->submit() }}
                    {{ arcanesoft\ui\action_button('deactivate')->id('deactivate-user-btn')->submit() }}
                </x-arc:modal-footer>
            </x-arc:form>
        </x-arc:modal>
    @endpush

    @push('scripts')
        <script defer>
            let activateUserModal  = components.modal('div#activate-user-modal')
            let activateUserForm   = components.form('form#activate-user-form')
            let activateUserAction = activateUserForm.action()

            ARCANESOFT.on('authorization::users.activate', ({id, status}) => {
                activateUserForm.action(activateUserAction.replace(":id", id))
                const modal = activateUserModal.elt()

                let modalTitle = modal.querySelector('#activate-user-modal-title')
                let modalMessage = modal.querySelector('#activate-user-modal-message')
                let activateBtn = modal.querySelector('#activate-user-btn')
                let deactivateBtn = modal.querySelector('#deactivate-user-btn')

                if (status === 'activated') {
                    modalTitle.innerHTML = '@lang("Deactivate User")'
                    modalMessage.innerHTML = '@lang("Are you sure you want to deactivate this user ?")'
                    activateBtn.style.display = 'none'
                    deactivateBtn.style.display = ''
                }
                else {
                    modalTitle.innerHTML = '@lang("Activate User")'
                    modalMessage.innerHTML = '@lang("Are you sure you want to activate this user ?")'
                    activateBtn.style.display = ''
                    deactivateBtn.style.display = 'none'
                }

                activateUserModal.show();
            })

            activateUserForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = activateUserForm.submitButton('button[type="submit"]:not([style*="display: none"])')

                submitBtn.loading()

                request()
                    .put(activateUserForm.action().toString())
                    .then(({ data }) => {
                        if (data && data.code === 'success') {
                            activateUserModal.hide()
                            location.reload()
                        }
                        else {
                            alert('ERROR ! Check the console !')
                        }
                    })
                    .catch((error) => {
                        alert('AJAX ERROR ! Check the console !')
                    })
                    .finally(() => {
                        submitBtn.reset()
                    })
            })

            activateUserModal.on('hidden', () => {
                activateUserForm.action(activateUserAction.toString())
            })
        </script>
    @endpush
@endcan

{{-- DELETE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('delete'))
    @push('modals')
        <x-arc:modal id="delete-user-modal" aria-labelledby="delete-user-modal-title" data-backdrop="static">
            <x-arc:form action="{{ route('admin::auth.users.delete', [':id']) }}" method="DELETE" id="delete-user-form">
                <x-arc:modal-header>
                    <x-arc:modal-title id="delete-user-modal-title">@lang('Delete User')</x-arc:modal-title>
                </x-arc:modal-header>
                <x-arc:modal-body id="delete-user-modal-message">
                    @lang('Are you sure you want to delete this user ?')
                </x-arc:modal-body>
                <x-arc:modal-footer class="justify-content-between">
                    <x-arc:modal-cancel-button/>
                    {{ arcanesoft\ui\action_button('delete')->submit() }}
                </x-arc:modal-footer>
            </x-arc:form>
        </x-arc:modal>
    @endpush

    @push('scripts')
        <script defer>
            let deleteUserModal  = components.modal('div#delete-user-modal')
            let deleteUserForm   = components.form('form#delete-user-form')
            let deleteUserAction = deleteUserForm.action()

            ARCANESOFT.on('authorization::users.delete', ({id}) => {
                deleteUserForm.action(deleteUserAction.replace(':id', id))

                deleteUserModal.show()
            })

            deleteUserForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = deleteUserForm.submitButton()

                submitBtn.loading()

                request()
                    .delete(deleteUserForm.action().toString())
                    .then(({ data }) => {
                        if (data && data.code === 'success') {
                            deleteUserModal.hide()
                            location.reload()
                        }
                        else {
                            alert('ERROR ! Check the console !')
                        }
                    })
                    .catch((error) => {
                        alert('AJAX ERROR ! Check the console !')
                        console.log(error)
                    })
                    .finally(() => {
                        submitBtn.reset()
                    })
            })

            deleteUserModal.on('hidden', () => {
                deleteUserForm.action(deleteUserAction.toString())
            })
        </script>
    @endpush
@endcan

{{-- RESTORE MODAL/SCRIPT --}}
@if ($trash)
@can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('restore'))
    @push('modals')
        <x-arc:modal id="restore-user-modal" aria-labelledby="restore-user-modal-title" data-backdrop="static">
            <x-arc:form action="{{ route('admin::auth.users.restore', [':id']) }}" method="PUT" id="restore-user-form">
                <x-arc:modal-header>
                    <x-arc:modal-title id="restore-user-modal-title">@lang('Restore User')</x-arc:modal-title>
                </x-arc:modal-header>
                <x-arc:modal-body id="restore-user-modal-message">
                    @lang('Are you sure you want to restore this user ?')
                </x-arc:modal-body>
                <x-arc:modal-footer class="justify-content-between">
                    <x-arc:modal-cancel-button/>
                    {{ arcanesoft\ui\action_button('restore')->submit() }}
                </x-arc:modal-footer>
            </x-arc:form>
        </x-arc:modal>
    @endpush

    @push('scripts')
        <script>
            let restoreUserModal  = components.modal('div#restore-user-modal')
            let restoreUserForm   = components.form('form#restore-user-form')
            let restoreUserAction = restoreUserForm.action()

            ARCANESOFT.on('authorization::users.restore', ({id}) => {
                restoreUserForm.action(restoreUserAction.replace(':id', id))

                restoreUserModal.show()
            })

            restoreUserForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = restoreUserForm.submitButton()

                submitBtn.loading()

                request()
                    .put(restoreUserForm.action().toString())
                    .then(({ data }) => {
                        if (data && data.code === 'success') {
                            restoreUserModal.hide()
                            location.reload()
                        }
                        else {
                            alert('ERROR ! Check the console !')
                        }
                    })
                    .catch((error) => {
                        alert('AJAX ERROR ! Check the console !')
                        console.log(error)
                    })
                    .finally(() => {
                        submitBtn.reset()
                    })
            })

            restoreUserModal.on('hidden', () => {
                restoreUserForm.setAction(restoreUserAction.toString())
            })
        </script>
    @endpush
@endcan
@endif
