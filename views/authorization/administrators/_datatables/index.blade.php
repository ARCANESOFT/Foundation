<?php
/**
 * @var  Arcanesoft\Foundation\Auth\Models\Administrator[]|Illuminate\Pagination\LengthAwarePaginator  $administrators
 * @var  array                                                                                         $fields
 */
?>

<x-arc:card>
    @if($administrators->isNotEmpty())
        <x-arc:card-header>
            @include('foundation::_includes.datatable.datatable-header')
        </x-arc:card-header>
        <x-arc:card-table>
            <thead>
                <tr>
                    <x-arc:table-th>{{ $fields['first_name'] }}</x-arc:table-th>
                    <x-arc:table-th>{{ $fields['last_name'] }}</x-arc:table-th>
                    <x-arc:table-th>{{ $fields['email'] }}</x-arc:table-th>
                    <x-arc:table-th>{{ $fields['created_at'] }}</x-arc:table-th>
                    <x-arc:table-th class="text-center">{{ $fields['status'] }}</x-arc:table-th>
                    <x-arc:table-th class="text-right">{{ $fields['actions'] }}</x-arc:table-th>
                </tr>
            </thead>
            <tbody>
                @foreach ($administrators as $administrator)
                    <tr>
                        <td class="small">{{ $administrator->first_name }}</td>
                        <td class="small">{{ $administrator->last_name }}</td>
                        <td class="small">{{ $administrator->email }}</td>
                        <td class="small text-muted">{{ $administrator->created_at }}</td>
                        <td class="text-center">
                            <x-arc:badge-active value="{{ $administrator->isActive() }}" icon="true"/>
                        </td>
                        <td class="text-right">
                            {{-- SHOW --}}
                            <x-arc:datatable-action
                                type="show"
                                action="{{ route('admin::auth.administrators.show', [$administrator]) }}"
                                allowed="{{ Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::can('show', [$administrator]) }}"/>

                            {{-- UPDATE --}}
                            <x-arc:datatable-action
                                type="edit"
                                action="{{ route('admin::auth.administrators.edit', [$administrator]) }}"
                                allowed="{{ Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::can('update', [$administrator]) }}"/>

                            {{-- ACTIVATE/DEACTIVATE --}}
                            @if ($administrator->isActive())
                                <x-arc:datatable-action
                                    type="deactivate"
                                    action="ARCANESOFT.emit('authorization::administrators.deactivate', {id: '{{ $administrator->getRouteKey() }}'})"
                                    allowed="{{ Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::can('deactivate', [$administrator]) }}"/>
                            @else
                                <x-arc:datatable-action
                                    type="activate"
                                    action="ARCANESOFT.emit('authorization::administrators.activate', {id: '{{ $administrator->getRouteKey() }}'})"
                                    allowed="{{ Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::can('activate', [$administrator]) }}"/>
                            @endif

                            {{-- RESTORE --}}
                            @if($trash)
                                <x-arc:datatable-action
                                    type="restore"
                                    action="ARCANESOFT.emit('authorization::administrators.restore', {id: '{{ $administrator->getRouteKey() }}' })"
                                    allowed="{{ Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::can('restore', [$administrator]) }}"/>
                            @endif

                            {{-- DELETE --}}
                            <x-arc:datatable-action
                                type="delete"
                                action="ARCANESOFT.emit('authorization::administrators.delete', {id: '{{ $administrator->getRouteKey() }}' })"
                                allowed="{{ Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::can('delete', [$administrator]) }}"/>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-arc:card-table>
        <x-arc:card-footer>
            <x-arc:datatable-pagination :paginator="$administrators"/>
        </x-arc:card-footer>
    @else
        @include('foundation::_partials.no-data-found')
    @endif
</x-arc:card>
