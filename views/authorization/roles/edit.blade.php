@extends(arcanesoft\foundation()->template())

<?php
/**
 * @var  Arcanesoft\Foundation\Authorization\Models\Role                                                   $role
 * @var  Arcanesoft\Foundation\Authorization\Models\Permission[]|\Illuminate\Database\Eloquent\Collection  $permissions
 */
?>

@section('page-title')
    <i class="fas fa-fw fa-user-tag"></i> @lang('Roles') <small>@lang('Edit Role')</small>
@endsection

@section('content')
    <x-arc:form action="{{ route('admin::authorization.roles.update', [$role]) }}" method="PUT">
        <div class="row">
            <div class="col-md-4">
                {{-- ROLE --}}
                <x-arc:card>
                    <x-arc:card-header>@lang('Role')</x-arc:card-header>
                    <x-arc:card-body>
                        <div class="row g-3">
                            <div class="col-12">
                                {{-- NAME --}}
                                <x-arc:input-control
                                    type="text" name="name" :value="old('name', $role->name)" label="Name" required/>
                            </div>
                            <div class="col-12">
                                {{-- DESCRIPTION --}}
                                <x-arc:textarea-control
                                    name="description" :value="old('description', $role->description)" label="Description" required/>
                            </div>
                        </div>
                    </x-arc:card-body>
                    <x-arc:card-footer class="d-flex justify-content-between">
                        <x-arc:form-cancel-button to="{{ route('admin::authorization.roles.show', [$role]) }}"/>
                        <x-arc:form-submit-button type="save"/>
                    </x-arc:card-footer>
                </x-arc:card>
            </div>
            <div class="col-md-8">
                {{-- PERMISSIONS --}}
                <x-arc:card>
                    <x-arc:card-header>@lang('Permissions')</x-arc:card-header>
                    <x-arc:card-table>
                        <thead>
                            <tr>
                                <x-arc:table-th label="#"/>
                                <x-arc:table-th label="Group"/>
                                <x-arc:table-th label="Category"/>
                                <x-arc:table-th label="Name"/>
                                <x-arc:table-th label="Description"/>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($permissions as $permission)
                            <tr>
                                <td>
                                    {{ form()->checkbox('permissions[]', $permission->getRouteKey(), in_array($permission->getRouteKey(), old('permissions', $role->permissions->pluck($permission->getRouteKeyName())->toArray()))) }}
                                </td>
                                <td class="small">{{ $permission->group->name }}</td>
                                <td class="small">{{ $permission->category }}</td>
                                <td class="small">{{ $permission->name }}</td>
                                <td class="small">{{ $permission->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">@lang('The list is empty!')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </x-arc:card-table>
                </x-arc:card>
            </div>
        </div>
    </x-arc:form>
@endsection
