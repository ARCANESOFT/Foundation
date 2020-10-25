<?php
/**
 * @var  Illuminate\Pagination\LengthAwarePaginator|Arcanesoft\Foundation\Auth\Models\User[]  $users
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
                            <div class="avatar avatar-sm bg-light">{{ $user->avatar_img }}</div>
                        </td>
                        <td class="small">{{ $user->first_name }}</td>
                        <td class="small">{{ $user->last_name }}</td>
                        <td class="small">{{ $user->email }}</td>
                        <td class="small text-muted">{{ $user->created_at }}</td>
                        <td class="text-center">
                            <span class="status {{ $user->isActive() ? 'status-animated bg-success' : 'bg-secondary' }}"
                                  data-toggle="tooltip" data-placement="top" title="@lang($user->isActive() ? 'Activated' : 'Deactivated')"></span>
                        </td>
                        <td class="text-right">
                            {{-- SHOW --}}
                            <x-arc:datatable-action
                                type="show"
                                action="{{ route('admin::auth.users.show', [$user]) }}"
                                allowed="{{ Arcanesoft\Foundation\Auth\Policies\UsersPolicy::can('show', [$user]) }}"/>

                            {{-- EDIT --}}
                            <x-arc:datatable-action
                                type="edit"
                                action="{{ route('admin::auth.users.edit', [$user]) }}"
                                allowed="{{ Arcanesoft\Foundation\Auth\Policies\UsersPolicy::can('update', [$user]) }}"/>

                            {{-- ACTIVATE/DEACTIVATE --}}
                            <x-arc:datatable-action
                                type="{{ $user->isActive() ? 'deactivate' : 'activate' }}"
                                action="ARCANESOFT.emit('authorization::users.activate', {id: '{{ $user->getRouteKey() }}', status: '{{ $user->isActive() ? 'activated' : 'deactivated' }}'})"
                                allowed="{{ Arcanesoft\Foundation\Auth\Policies\UsersPolicy::can('activate', [$user]) }}"/>

                            {{-- RESTORE --}}
                            @if($trash)
                                <x-arc:datatable-action
                                    type="restore"
                                    action="ARCANESOFT.emit('authorization::users.restore', {id: '{{ $user->getRouteKey() }}' })"
                                    allowed="{{ Arcanesoft\Foundation\Auth\Policies\UsersPolicy::can('restore', [$user]) }}"/>
                            @endif

                            {{-- DELETE --}}
                            <x-arc:datatable-action
                                type="delete"
                                action="ARCANESOFT.emit('authorization::users.delete', {id: '{{ $user->getRouteKey() }}' })"
                                allowed="{{ Arcanesoft\Foundation\Auth\Policies\UsersPolicy::can('delete', [$user]) }}"/>
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
