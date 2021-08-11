<?php /** @var  Arcanesoft\Foundation\Authorization\Models\Permission[]|\Illuminate\Database\Eloquent\Collection  $permissions */ ?>
<x-arc:layout>
    @section('page-title')
        <i class="fas fa-fw fa-user-tag"></i> @lang('Roles') <small>@lang('New Role')</small>
    @endsection

    <x-arc:form action="{{ route('admin::authorization.roles.store') }}">
        <div class="row row-cols-1 g-4">
            <div class="col">
                {{-- ROLE --}}
                <x-arc:card>
                    <x-arc:card-header>@lang('Role')</x-arc:card-header>
                    <x-arc:card-body>
                        <div class="row g-3">
                            <div class="col-12">
                                {{-- NAME --}}
                                <x-arc:input-control
                                    type="text" name="name" label="Name" required/>
                            </div>
                            <div class="col-12">
                                {{-- DESCRIPTION --}}
                                <x-arc:textarea-control
                                    name="description" label="Description" required/>
                            </div>
                        </div>
                    </x-arc:card-body>
                </x-arc:card>
            </div>
            <div class="col">
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
                                    <x-arc:checkbox
                                        name="permissions[]" :value="$permission->getRouteKey()"
                                        :checked="in_array($permission->getRouteKey(), old('permissions', $selectedPermissions))"/>
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
            <div class="col">
                <x-arc:card>
                    <x-arc:card-footer class="d-flex justify-content-between">
                        <x-arc:form-cancel-button to="{{ route('admin::authorization.roles.index') }}"/>
                        <x-arc:form-submit-button type="save"/>
                    </x-arc:card-footer>
                </x-arc:card>
            </div>
        </div>
    </x-arc:form>
</x-arc:layout>
