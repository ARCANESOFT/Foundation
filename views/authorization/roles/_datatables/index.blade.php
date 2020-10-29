<?php
/**
 * @var  Illuminate\Pagination\LengthAwarePaginator|Arcanesoft\Foundation\Authorization\Models\Role[]  $roles
 * @var  array                                                                                $fields
 */
?>

<x-arc:card>
    @if ($roles->isNotEmpty())
        <x-arc:card-header>
            @include('foundation::_includes.datatable.datatable-header')
        </x-arc:card-header>
        <x-arc:card-table>
            <thead>
                <tr>
                    <x-arc:table-th>{{ $fields['name'] }}</x-arc:table-th>
                    <x-arc:table-th>{{ $fields['description'] }}</x-arc:table-th>
                    <x-arc:table-th>{{ $fields['created_at'] }}</x-arc:table-th>
                    <x-arc:table-th class="text-center">{{ $fields['administrators'] }}</x-arc:table-th>
                    <x-arc:table-th class="text-center">{{ $fields['locked'] }}</x-arc:table-th>
                    <x-arc:table-th class="text-center">{{ $fields['status'] }}</x-arc:table-th>
                    <x-arc:table-th class="text-right">{{ $fields['actions'] }}</x-arc:table-th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td class="small">{{ $role->name }}</td>
                        <td class="small">{{ $role->description }}</td>
                        <td class="small text-muted">{{ $role->created_at }}</td>
                        <td class="text-center">
                            <x-arc:badge-count value="{{ $role->administrators_count }}"/>
                        </td>
                        <td class="text-center">
                            <span class="status {{ $role->isLocked() ? 'bg-danger' : 'bg-secondary' }}"
                                  data-toggle="tooltip" title="@lang($role->isLocked() ? 'Locked' : 'Unlocked')"></span>
                        </td>
                        <td class="text-center">
                            <x-arc:badge-active value="{{ $role->isActive() }}" icon="true"/>
                        </td>
                        <td class="text-right">
                            {{-- SHOW --}}
                            <x-arc:datatable-action
                                type="show"
                                action="{{ route('admin::authorization.roles.show', [$role]) }}"
                                allowed="{{ Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::can('show', [$role]) }}"/>

                            {{-- UPDATE --}}
                            <x-arc:datatable-action
                                type="edit"
                                action="{{ route('admin::authorization.roles.edit', [$role]) }}"
                                allowed="{{ Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::can('update', [$role]) }}"/>

                            {{-- ACTIVATE/DEACTIVATE --}}
                            @if ($role->isActive())
                                <x-arc:datatable-action
                                    type="deactivate"
                                    action="ARCANESOFT.emit('authorization::roles.deactivate', {id: '{{ $role->getRouteKey() }}'})"
                                    allowed="{{ Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::can('deactivate', [$role]) }}"/>
                            @else
                                <x-arc:datatable-action
                                    type="activate"
                                    action="ARCANESOFT.emit('authorization::roles.activate', {id: '{{ $role->getRouteKey() }}'})"
                                    allowed="{{ Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::can('activate', [$role]) }}"/>
                            @endif

                            {{-- DELETE --}}
                            <x-arc:datatable-action
                                type="delete"
                                action="ARCANESOFT.emit('authorization::roles.delete', {id: '{{ $role->getRouteKey() }}' })"
                                allowed="{{ Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::can('delete', [$role]) }}"/>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-arc:card-table>
        <x-arc:card-footer>
            <x-arc:datatable-pagination :paginator="$roles"/>
        </x-arc:card-footer>
    @else
        @include('foundation::_partials.no-data-found')
    @endif
</x-arc:card>
