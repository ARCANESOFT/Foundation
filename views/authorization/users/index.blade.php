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
    <v-datatable name="{{ Arcanesoft\Foundation\Auth\Views\Components\UsersDatatable::NAME }}"
                 :trash="{{ $trash ? 'true' : 'false' }}"></v-datatable>
@endsection

{{-- ACTIVATE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('activate'))
    @push('modals')
        <div class="modal fade" id="activate-user-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="activateUserTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.users.activate', ':id'], 'method' => 'PUT', 'id' => 'activate-user-form']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="activateUserTitle"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="activateUserMessage" class="modal-body">
                    </div>
                    <div class="modal-footer justify-content-between">
                        {{ arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                        {{ arcanesoft\ui\action_button('activate')->id('activateUserBtn')->submit() }}
                        {{ arcanesoft\ui\action_button('deactivate')->id('deactivateUserBtn')->submit() }}
                    </div>
                </div>
                {{ form()->close() }}
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            let activateUserModal  = twbs.Modal.make('div#activate-user-modal')
            let activateUserForm   = Form.make('form#activate-user-form')
            let activateUserAction = activateUserForm.getAction()

            Foundation.$on('auth::users.activate', ({id, status}) => {
                activateUserForm.setAction(activateUserAction.replace(":id", id))
                let modal = activateUserModal._element

                if (status === 'activated') {
                    modal.querySelector('#activateUserTitle').innerHTML = '@lang("Deactivate User")'
                    modal.querySelector('#activateUserMessage').innerHTML = '@lang("Are you sure you want to deactivate this user ?")'
                    modal.querySelector('#activateUserBtn').style.display = 'none'
                    modal.querySelector('#deactivateUserBtn').style.display = ''
                }
                else {
                    modal.querySelector('#activateUserTitle').innerHTML = '@lang("Activate User")'
                    modal.querySelector('#activateUserMessage').innerHTML = '@lang("Are you sure you want to activate this user ?")'
                    modal.querySelector('#activateUserBtn').style.display = ''
                    modal.querySelector('#deactivateUserBtn').style.display = 'none'
                }

                activateUserModal.show();
            })

            activateUserForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = Foundation.ui.loadingButton(
                    activateUserForm.elt().querySelector('button[type="submit"]:not([style*="display: none"])')
                )
                submitBtn.loading()

                request()
                    .put(activateUserForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            activateUserModal.hide()
                            location.reload()
                        }
                        else {
                            alert('ERROR ! Check the console !')
                            submitBtn.reset()
                        }
                    })
                    .catch((error) => {
                        alert('AJAX ERROR ! Check the console !')
                        submitBtn.reset()
                    })
            })

            activateUserModal.on('hidden', () => {
                activateUserForm.setAction(activateUserAction)
            })
        </script>
    @endpush
@endcan

{{-- DELETE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('delete'))
    @push('modals')
        <div class="modal fade" id="delete-user-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.users.delete', ':id'], 'method' => 'DELETE', 'id' => 'delete-user-form']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">@lang('Delete User')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @lang('Are you sure you want to delete this user ?')
                    </div>
                    <div class="modal-footer justify-content-between">
                        {{ arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                        {{ arcanesoft\ui\action_button('delete')->submit() }}
                    </div>
                </div>
                {{ form()->close() }}
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            let deleteUserModal = twbs.Modal.make('div#delete-user-modal')
            let deleteUserForm  = Form.make('form#delete-user-form')
            let deleteUserAction = deleteUserForm.getAction()

            Foundation.$on('auth::users.delete', ({id}) => {
                deleteUserForm.setAction(deleteUserAction.replace(':id', id))
                deleteUserModal.show()
            })

            deleteUserForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = Foundation.ui.loadingButton(
                    deleteUserForm.elt().querySelector('button[type="submit"]')
                )
                submitBtn.loading()

                request()
                    .delete(deleteUserForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            deleteUserModal.hide()
                            location.reload()
                        }
                        else {
                            alert('ERROR ! Check the console !')
                            submitBtn.reset()
                        }
                    })
                    .catch((error) => {
                        alert('AJAX ERROR ! Check the console !')
                        console.log(error)
                        submitBtn.reset()
                    })
            })

            deleteUserModal.on('hidden', () => {
                deleteUserForm.setAction(deleteUserAction)
            })
        </script>
    @endpush
@endcan

{{-- RESTORE MODAL/SCRIPT --}}
@if ($trash)
@can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('restore'))
    @push('modals')
        <div class="modal fade" id="restore-user-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.users.restore', ':id'], 'method' => 'PUT', 'id' => 'restore-user-form']) }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelTitleId">@lang('Restore User')</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @lang('Are you sure you want to restore this user ?')
                        </div>
                        <div class="modal-footer justify-content-between">
                            {{ arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                            {{ arcanesoft\ui\action_button('restore')->submit() }}
                        </div>
                    </div>
                {{ form()->close() }}
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            let restoreUserModal  = twbs.Modal.make('div#restore-user-modal')
            let restoreUserForm   = Form.make('form#restore-user-form')
            let restoreUserAction = restoreUserForm.getAction()

            Foundation.$on('auth::users.restore', ({id}) => {
                restoreUserForm.setAction(restoreUserAction.replace(':id', id))
                restoreUserModal.show()
            })

            restoreUserForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = Foundation.ui.loadingButton(
                    restoreUserForm.elt().querySelector('button[type="submit"]')
                );
                submitBtn.loading()

                request()
                    .put(restoreUserForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            restoreUserModal.hide()
                            location.reload()
                        }
                        else {
                            alert('ERROR ! Check the console !')
                            submitBtn.reset()
                        }
                    })
                    .catch((error) => {
                        alert('AJAX ERROR ! Check the console !')
                        console.log(error)
                        submitBtn.reset()
                    })
            });

            restoreUserModal.on('hidden', () => {
                restoreUserForm.setAction(restoreUserAction)
            })
        </script>
    @endpush
@endcan
@endif
