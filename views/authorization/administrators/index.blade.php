@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-user-secret"></i> @lang('Administrators')
@endsection

@push('content-nav')
    <div class="mt-2 mb-3 text-right">
        @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('metrics'))
        <a href="{{ route('admin::auth.administrators.metrics') }}" class="btn btn-sm btn-secondary {{ active(['admin::auth.administrators.metrics']) }}">@lang('Metrics')</a>
        @endcan

        @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('index'))
        <div class="btn-group ml-auto" role="group" aria-label="Administrators lists">
            <a href="{{ route('admin::auth.administrators.index') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::auth.administrators.index']) }}">@lang('All')</a>
            <a href="{{ route('admin::auth.administrators.trash') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::auth.administrators.trash']) }}">@lang('Trash')</a>
        </div>
        @endcan

        @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('create'))
        {{ arcanesoft\ui\action_link('add', route('admin::auth.administrators.create'))->size('sm') }}
        @endcan
    </div>
@endpush

@section('content')
    <v-datatable name="{{ Arcanesoft\Foundation\Auth\Views\Components\AdministratorsDatatable::NAME }}"
                 :trash="{{ $trash ? 'true' : 'false' }}"></v-datatable>
@endsection


{{-- ACIVATE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('activate'))
    @push('modals')
        <div class="modal fade" id="activate-user-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="activateAdministratorTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.administrators.activate', ':id'], 'method' => 'PUT', 'id' => 'activate-user-form']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="activateAdministratorTitle"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="activateAdministratorMessage" class="modal-body">
                    </div>
                    <div class="modal-footer justify-content-between">
                        {{ arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                        {{ arcanesoft\ui\action_button('activate')->id('activateAdministratorBtn')->submit() }}
                        {{ arcanesoft\ui\action_button('deactivate')->id('deactivateAdministratorBtn')->submit() }}
                    </div>
                </div>
                {{ form()->close() }}
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            let activateAdministratorModal = twbs.Modal.make('div#activate-user-modal')
            let activateAdministratorForm  = Form.make('form#activate-user-form')
            let activateAdministratorAction = activateAdministratorForm.getAction()

            Foundation.$on('authorization::administrators.activate', ({id, status}) => {
                activateAdministratorForm.setAction(activateAdministratorAction.replace(':id', id))
                const modal = activateAdministratorModal._element

                if (status === 'activated') {
                    modal.querySelector('#activateAdministratorTitle').innerHTML = "@lang('Deactivate User')"
                    modal.querySelector('#activateAdministratorMessage').innerHTML = "@lang('Are you sure you want to deactivate this user ?')"
                    modal.querySelector('#activateAdministratorBtn').style.display = 'none'
                    modal.querySelector('#deactivateAdministratorBtn').style.display = ''
                }
                else {
                    modal.querySelector('#activateAdministratorTitle').innerHTML = "@lang('Activate User')"
                    modal.querySelector('#activateAdministratorMessage').innerHTML = "@lang('Are you sure you want to activate this user ?')"
                    modal.querySelector('#activateAdministratorBtn').style.display = ''
                    modal.querySelector('#deactivateAdministratorBtn').style.display = 'none'
                }

                activateAdministratorModal.show()
            })

            activateAdministratorForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = Foundation.ui.loadingButton(
                    activateAdministratorForm.elt().querySelector('button[type="submit"]:not([style*="display: none"])')
                );
                submitBtn.loading()

                request()
                    .put(activateAdministratorForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            activateAdministratorModal.hide()
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

            activateAdministratorModal.on('hidden', () => {
                activateAdministratorForm.setAction(activateAdministratorAction)
            })
        </script>
    @endpush
@endcan

{{-- DELETE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('delete'))
    @push('modals')
        <div class="modal fade" id="delete-administrator-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.administrators.delete', ':id'], 'method' => 'DELETE', 'id' => 'delete-administrator-form']) }}
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
            let deleteAdministratorModal  = twbs.Modal.make('div#delete-administrator-modal')
            let deleteAdministratorForm   = Form.make('form#delete-administrator-form')
            let deleteAdministratorAction = deleteAdministratorForm.getAction()

            Foundation.$on('authorization::administrators.delete', ({id}) => {
                deleteAdministratorForm.setAction(deleteAdministratorAction.replace(':id', id))
                deleteAdministratorModal.show()
            })

            deleteAdministratorForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = Foundation.ui.loadingButton(
                    deleteAdministratorForm.elt().querySelector('button[type="submit"]')
                )
                submitBtn.loading()

                request()
                    .delete(deleteAdministratorForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            deleteAdministratorModal.hide()
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

            deleteAdministratorModal.on('hidden', () => {
                deleteAdministratorForm.setAction(deleteAdministratorAction)
            })
        </script>
    @endpush
@endcan

{{-- RESTORE MODAL/SCRIPT --}}
@if ($trash)
@can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('restore'))
    @push('modals')
        <div class="modal fade" id="restore-user-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.administrators.restore', ':id'], 'method' => 'PUT', 'id' => 'restore-user-form']) }}
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
            let restoreAdministratorModal  = twbs.Modal.make('div#restore-user-modal')
            let restoreAdministratorForm   = Form.make('form#restore-user-form')
            let restoreAdministratorAction = restoreAdministratorForm.getAction()

            Foundation.$on('authorization::administrators.restore', ({id}) => {
                restoreAdministratorForm.setAction(restoreAdministratorAction.replace(':id', id))
                restoreAdministratorModal.show()
            })

            restoreAdministratorForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = Foundation.ui.loadingButton(
                    restoreAdministratorForm.elt().querySelector('button[type="submit"]')
                )
                submitBtn.loading()

                request()
                    .put(restoreAdministratorForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            restoreAdministratorModal.hide()
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

            restoreAdministratorModal.on('hidden', () => {
                restoreAdministratorForm.setAction(restoreAdministratorAction);
            })
        </script>
    @endpush
@endcan
@endif

