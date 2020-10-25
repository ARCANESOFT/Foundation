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
            {{ arcanesoft\ui\action_link('add', route('admin::auth.roles.create'))->size('sm') }}
        @endcan
    </div>
@endpush

@section('content')
    <v-datatable name="{{ Arcanesoft\Foundation\Auth\Views\Components\RolesDatatable::NAME }}"></v-datatable>
@endsection

{{-- ACIVATE MODAL --}}
@can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('activate'))
    @push('modals')
        <div class="modal fade" id="activate-role-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="activateRoleTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.roles.activate', ':id'], 'method' => 'PUT', 'id' => 'activate-role-form']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="activateRoleTitle"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer justify-content-between">
                        {{ arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                        {{ arcanesoft\ui\action_button('activate')->id('activateRoleBtn')->submit() }}
                        {{ arcanesoft\ui\action_button('deactivate')->id('deactivateRoleBtn')->submit() }}
                    </div>
                </div>
                {{ form()->close() }}
            </div>
        </div>
    @endpush

    @push('scripts')
        <script defer>
            let activateRoleModal  = twbs.Modal.make(document.querySelector('div#activate-role-modal'))
            let activateRoleForm   = components.form('form#activate-role-form')
            let activateRoleAction = activateRoleForm.getAction()

            ARCANESOFT.on('auth::roles.activate', ({id, status}) => {
                activateRoleForm.setAction(activateRoleAction.replace(':id', id))

                const modal = activateRoleModal._element;

                if (status === 'deactivated') {
                    modal.querySelector('.modal-title').innerHTML = "@lang('Activate Role')"
                    modal.querySelector('.modal-body').innerHTML = "@lang('Are you sure you want to activate role ?')"
                    modal.querySelector('#activateRoleBtn').style.display = ''
                    modal.querySelector('#deactivateRoleBtn').style.display = 'none'
                }
                else if (status === 'activated') {
                    modal.querySelector('.modal-title').innerHTML = "@lang('Deactivate Role')"
                    modal.querySelector('.modal-body').innerHTML = "@lang('Are you sure you want to deactivate role ?')"
                    modal.querySelector('#activateRoleBtn').style.display = 'none'
                    modal.querySelector('#deactivateRoleBtn').style.display = ''
                }

                activateRoleModal.show()
            })

            activateRoleForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = components.loadingButton(
                    activateRoleForm
                        .elt()
                        .querySelector('button[type="submit"]:not([style*="display: none"])')
                )
                submitBtn.loading()

                ARCANESOFT
                    .request()
                    .put(activateRoleForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            activateRoleModal.hide()
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

            activateRoleModal.on('hidden', () => {
                activateRoleForm.setAction(activateRoleAction)
            })
        </script>
    @endpush
@endcan


{{-- DELETE MODAL --}}
@can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('delete'))
    @push('modals')
        <div class="modal fade" id="delete-role-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.roles.delete', ':id'], 'method' => 'DELETE', 'id' => 'delete-role-form']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">@lang('Delete Role')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @lang('Are you sure you want to delete this role ?')
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
        <script defer>
            let deleteRoleModal  = twbs.Modal.make('div#delete-role-modal')
            let deleteRoleForm   = components.form('form#delete-role-form')
            let deleteRoleAction = deleteRoleForm.getAction()

            ARCANESOFT.on('auth::roles.delete', ({id}) => {
                deleteRoleForm.setAction(deleteRoleAction.replace(':id', id))
                deleteRoleModal.show()
            })

            deleteRoleForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = components.loadingButton(
                    deleteRoleForm.elt().querySelector('button[type="submit"]')
                )
                submitBtn.loading()

                ARCANESOFT
                    .request()
                    .delete(deleteRoleForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            deleteRoleModal.modal('hide')
                            location.reload()
                        }
                        else {
                            alert('ERROR ! Check the console !')
                            submitBtn.button('reset')
                        }
                    })
                    .catch((error) => {
                        alert('AJAX ERROR ! Check the console !')
                        console.log(error)
                        submitBtn.button('reset')
                    })
            })

            deleteRoleModal.on('hidden', () => {
                deleteRoleForm.setAction(deleteRoleAction)
            })
        </script>
    @endpush
@endcan
