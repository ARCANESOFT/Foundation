@extends(arcanesoft\foundation()->template())

<?php /** @var  Arcanesoft\Foundation\Auth\Models\Permission  $permission */ ?>

@section('page-title')
    <i class="fas fa-fw fa-shield-alt"></i> @lang('Permissions') <small>@lang("Permission's details")</small>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-5 col-lg-4">
            <div class="row row-cols-1 g-4">
                <div class="col">
                    {{-- Permission --}}
                    <x-arc:card>
                        <x-arc:card-header>@lang('Permission')</x-arc:card-header>
                        <x-arc:card-table>
                            <tbody>
                            <tr>
                                <x-arc:table-th label="Group"/>
                                <td class="text-right small">{{ $permission->group->name }}</td>
                            </tr>
                            <tr>
                                <x-arc:table-th label="Category"/>
                                <td class="text-right small">{{ $permission->category }}</td>
                            </tr>
                            <tr>
                                <x-arc:table-th label="Name"/>
                                <td class="text-right small">{{ $permission->name }}</td>
                            </tr>
                            <tr>
                                <x-arc:table-th label="Description"/>
                                <td class="text-right small">{{ $permission->description }}</td>
                            </tr>
                            <tr>
                                <x-arc:table-th label="Roles"/>
                                <td class="text-right">
                                    <x-arc:badge-count value="{{ $roles->count() }}"/>
                                </td>
                            </tr>
                            <tr>
                                <x-arc:table-th label="Created at"/>
                                <td class="text-right small text-muted">{{ $permission->created_at }}</td>
                            </tr>
                            </tbody>
                        </x-arc:card-table>
                    </x-arc:card>
                </div>
                <div class="col">
                    {{-- Gate --}}
                    @can(Arcanesoft\Foundation\System\Policies\AbilitiesPolicy::ability('show'))
                        <x-arc:card>
                            <x-arc:card-header>@lang('Gate')</x-arc:card-header>
                            <x-arc:card-table>
                                <tbody>
                                <tr>
                                    <x-arc:table-th label="Ability"/>
                                    <td class="text-right">
                                        <div class="badge border border-secondary text-secondary font-monospace">{{ $permission->ability }}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <x-arc:table-th label="Registered"/>
                                    <td class="text-right">
                                        @if ($permission->isAbilityRegistered())
                                            <span class="badge border border-success text-success" data-toggle="tooltip" title="@lang('Yes')">
                                                <i class="fas fa-fw fa-check"></i>
                                            </span>
                                        @else
                                            <span class="badge border border-secondary text-secondary" data-toggle="tooltip" title="@lang('No')">
                                                <i class="fas fa-fw fa-ban"></i>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </x-arc:card-table>
                            <x-arc:card-footer class="d-flex justify-content-end">
                                {{-- SHOW --}}
                                <a href="{{ route('admin::system.abilities.show', $permission->ability) }}"
                                   class="btn btn-sm btn-secondary">@lang('Show')</a>
                            </x-arc:card-footer>
                        </x-arc:card>
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-md-7 col-lg-8">
            {{-- ROLES --}}
            @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('index'))
                <x-arc:card>
                    <x-arc:card-header>@lang('Roles')</x-arc:card-header>
                    <x-arc:card-table class="table-hover">
                        <thead>
                            <tr>
                                <x-arc:table-th label="Name"/>
                                <x-arc:table-th label="Description"/>
                                <x-arc:table-th label="Users" class="text-center"/>
                                <x-arc:table-th label="Locked" class="text-center"/>
                                <x-arc:table-th label="Status" class="text-center"/>
                                <x-arc:table-th label="Actions" class="text-right"/>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td class="small">{{ $role->name }}</td>
                                    <td class="small">{{ $role->description }}</td>
                                    <td class="text-center">
                                        <x-arc:badge-count value="{{ $role->administrators->count() }}"/>
                                    </td>
                                    <td class="text-center">
                                        @if($role->isLocked())
                                            <span class="status bg-danger" data-toggle="tooltip" title="@lang('Locked')"></span>
                                        @else
                                            <span class="status bg-secondary" data-toggle="tooltip" title="@lang('Unlocked')"></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($role->isActive())
                                            <span class="status bg-success" data-toggle="tooltip" title="@lang('Activated')"></span>
                                        @else
                                            <span class="status bg-secondary" data-toggle="tooltip" title="@lang('Deactivated')"></span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('show'), [$role])
                                            <a href="{{ route('admin::auth.roles.show', [$role]) }}" class="btn btn-sm btn-light" data-toggle="tooltip" title="@lang('Show')">
                                                <i class="far fa-fw fa-eye"></i>
                                            </a>
                                        @endcan

                                        @can(Arcanesoft\Foundation\Auth\Policies\PermissionsPolicy::ability('roles.detach'), [$permission, $role])
                                            <button class="btn btn-sm btn-danger"
                                                    data-toggle="tooltip" data-placement="top" title="@lang('Detach')"
                                                    onclick="ARCANESOFT.emit('auth::permissions.detach-role', {id: '{{ $role->getRouteKey() }}', name: '{{ $role->name }}'})">
                                                <i class="fas fa-fw fa-unlink"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-arc:card-table>
                </x-arc:card>
            @endcan
        </div>
    </div>
@endsection

{{-- DETACH ROLE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Auth\Policies\PermissionsPolicy::ability('roles.detach'), $permission)
    @push('modals')
        <div class="modal fade" id="detach-role-modal" data-backdrop="static"
             tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => ['admin::auth.permissions.roles.detach', $permission, ':id'], 'method' => 'DELETE', 'id' => 'detach-role-form']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">@lang('Detach Role')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer justify-content-between">
                        {{ arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-fw fa-unlink"></i> @lang('Detach')
                        </button>
                    </div>
                </div>
                {{ form()->close() }}
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            let detachRoleModal  = twbs.Modal.make('div#detach-role-modal')
            let detachRoleForm   = components.form('form#detach-role-form')
            let detachRoleAction = detachRoleForm.getAction()

            ARCANESOFT.on('auth::permissions.detach-role', ({id, name}) => {
                detachRoleForm.setAction(detachRoleAction.replace(':id', id))

                detachRoleModal._element.querySelector('.modal-body').innerHTML = "@lang('Are you sure you want to detach role: :name ?')".replace(':name', name)

                detachRoleModal.show();
            });

            detachRoleForm.on('submit', (event) => {
                event.preventDefault()

                let submitBtn = components.loadingButton(
                    detachRoleForm.elt().querySelector('button[type="submit"]')
                )
                submitBtn.loading()

                request()
                    .delete(detachRoleForm.getAction())
                    .then((response) => {
                        if (response.data.code === 'success') {
                            detachRoleModal.hide()
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
            });

            detachRoleModal.on('hidden', () => {
                detachRoleForm.setAction(detachRoleAction);
            });
        </script>
    @endpush
@endcan
