<?php
/**
 * @var  Illuminate\Pagination\LengthAwarePaginator|Arcanesoft\Foundation\Authorization\Models\User[]  $users
 * @var  array                                                                                $fields
 */
?>

<x-arc:card>
    @if ($users->isNotEmpty())
        <x-arc:card-header>
            @include('foundation::_includes.datatable.datatable-header')
        </x-arc:card-header>
        <x-arc:card-table>
            <thead>
                <tr>
                    <x-arc:table-th>{{ $fields['avatar'] }}</x-arc:table-th>
                    <x-arc:table-th>{{ $fields['first_name'] }}</x-arc:table-th>
                    <x-arc:table-th>{{ $fields['last_name'] }}</x-arc:table-th>
                    <x-arc:table-th>{{ $fields['email'] }}</x-arc:table-th>
                    <x-arc:table-th>{{ $fields['created_at'] }}</x-arc:table-th>
                    <x-arc:table-th class="text-center">{{ $fields['status'] }}</x-arc:table-th>
                    <x-arc:table-th class="text-right">{{ $fields['actions'] }}</x-arc:table-th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="avatar avatar-sm rounded-circle bg-light">
                                <img src="{{ $user->avatar }}" alt="{{ $user->full_name }}">
                            </div>
                        </td>
                        <td class="small">{{ $user->first_name }}</td>
                        <td class="small">{{ $user->last_name }}</td>
                        <td class="small">{{ $user->email }}</td>
                        <td class="small text-muted">{{ $user->created_at }}</td>
                        <td class="text-center">
                            <x-arc:badge-active value="{{ $user->isActive() }}" icon="true"/>
                        </td>
                        <td class="text-right">
                            {{-- SHOW --}}
                            <x-arc:datatable-action
                                type="show"
                                action="{{ route('admin::authorization.users.show', [$user]) }}"
                                allowed="{{ Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::can('show', [$user]) }}"/>

                            {{-- EDIT --}}
                            <x-arc:datatable-action
                                type="edit"
                                action="{{ route('admin::authorization.users.edit', [$user]) }}"
                                allowed="{{ Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::can('update', [$user]) }}"/>

                            {{-- ACTIVATE/DEACTIVATE --}}
                            @if ($user->isActive())
                                <x-arc:datatable-action
                                    type="deactivate"
                                    action="ARCANESOFT.emit('authorization::users.deactivate', {id: '{{ $user->getRouteKey() }}'})"
                                    allowed="{{ Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::can('deactivate', [$user]) }}"/>
                            @else
                                <x-arc:datatable-action
                                    type="activate"
                                    action="ARCANESOFT.emit('authorization::users.activate', {id: '{{ $user->getRouteKey() }}'})"
                                    allowed="{{ Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::can('activate', [$user]) }}"/>
                            @endif

                            {{-- RESTORE --}}
                            @if($trash)
                                <x-arc:datatable-action
                                    type="restore"
                                    action="ARCANESOFT.emit('authorization::users.restore', {id: '{{ $user->getRouteKey() }}' })"
                                    allowed="{{ Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::can('restore', [$user]) }}"/>
                            @endif

                            {{-- DELETE --}}
                            <x-arc:datatable-action
                                type="delete"
                                action="ARCANESOFT.emit('authorization::users.delete', {id: '{{ $user->getRouteKey() }}' })"
                                allowed="{{ Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::can('delete', [$user]) }}"/>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-arc:card-table>
        <x-arc:card-footer>
            <x-arc:datatable-pagination :paginator="$users"/>
        </x-arc:card-footer>
    @else
        @include('foundation::_partials.no-data-found')
    @endif
</x-arc:card>
