@extends(arcanesoft\foundation()->template())

<?php /** @var  Arcanesoft\Foundation\Authorization\Models\Permission  $permission */ ?>

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
            @can(Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::ability('index'))
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
                                        {{-- SHOW --}}
                                        <x-arc:datatable-action
                                            type="show"
                                            action="{{ route('admin::authorization.roles.show', [$role]) }}"
                                            allowed="{{ Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::can('show', [$role]) }}"/>

                                        {{-- DETACH --}}
                                        <x-arc:datatable-action
                                            type="detach"
                                            action="ARCANESOFT.emit('authorization::permissions.roles.detach', {id: '{{ $role->getRouteKey() }}' })"
                                            allowed="{{ Arcanesoft\Foundation\Authorization\Policies\PermissionsPolicy::can('roles.detach', [$permission, $role]) }}"/>
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
@can(Arcanesoft\Foundation\Authorization\Policies\PermissionsPolicy::ability('roles.detach'), $permission)
    @push('modals')
        <x-arc:modal-action
            type="detach" id="detach-role"
            action="{{ route('admin::authorization.permissions.roles.detach', [$permission, ':id']) }}" method="DELETE"
            title="Detach Role"
            body="Are you sure you want to delete this role ?"
        />
    @endpush

    @push('scripts')
        <script>
            let detachRoleModal  = components.modal('div#detach-role-modal')
            let detachRoleForm   = components.form('form#detach-role-form')
            let detachRoleAction = detachRoleForm.action()

            ARCANESOFT.on('authorization::permissions.roles.detach', ({id}) => {
                detachRoleForm.action(detachRoleAction.replace(':id', id))
                detachRoleModal.show();
            });

            detachRoleForm.onSubmit('DELETE', () => {
                detachRoleModal.hide()
                location.reload()
            })

            detachRoleModal.on('hidden', () => {
                detachRoleForm.action(detachRoleAction.toString());
            });
        </script>
    @endpush
@endcan
