<?php
/**
 * @var  Illuminate\Pagination\LengthAwarePaginator|Arcanesoft\Foundation\Auth\Models\Permission[]  $permissions
 * @var  array                                                                                      $fields
 */
?>

<x-arc:card>
    @if ($permissions->isNotEmpty())
        <x-arc:card-header>
            @include('foundation::_includes.datatable.datatable-header')
        </x-arc:card-header>

        <x-arc:card-table>
            <thead>
                <tr>
                    <x-arc:table-th>{{ $fields['group'] }}</x-arc:table-th>
                    <x-arc:table-th>{{ $fields['category'] }}</x-arc:table-th>
                    <x-arc:table-th>{{ $fields['name'] }}</x-arc:table-th>
                    <x-arc:table-th>{{ $fields['description'] }}</x-arc:table-th>
                    <x-arc:table-th class="text-center">{{ $fields['roles'] }}</x-arc:table-th>
                    <x-arc:table-th class="text-right">{{ $fields['actions'] }}</x-arc:table-th>
                </tr>
            </thead>
            <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td class="small">{{ $permission->group->name }}</td>
                    <td class="small">{{ $permission->category }}</td>
                    <td class="small">{{ $permission->name }}</td>
                    <td class="small">{{ $permission->description }}</td>
                    <td class="text-center">
                        <x-arc:badge-count value="{{ $permission->roles_count }}"/>
                    </td>
                    <td class="text-right">
                        {{-- SHOW --}}
                        <x-arc:datatable-action
                            type="show"
                            action="{{ route('admin::auth.permissions.show', [$permission]) }}"
                            allowed="{{ Arcanesoft\Foundation\Auth\Policies\PermissionsPolicy::can('show', [$permission]) }}"/>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </x-arc:card-table>
        <x-arc:card-footer>
            <x-arc:datatable-pagination :paginator="$permissions" />
        </x-arc:card-footer>
    @else
        @include('foundation::_partials.no-data-found')
    @endif
</x-arc:card>
