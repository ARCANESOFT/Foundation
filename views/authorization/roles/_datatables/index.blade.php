<?php
/**
 * @var  Illuminate\Pagination\LengthAwarePaginator|Arcanesoft\Foundation\Auth\Models\Role[]  $roles
 * @var  array                                                                                $fields
 */
?>

<div class="card card-borderless shadow-sm">
    @if ($roles->isNotEmpty())
        <div class="card-header px-2">
            @include('foundation::_includes.datatable.datatable-header')
        </div>
        <table class="table table-borderless table-hover table-md mb-0">
            <thead>
                <tr>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['name'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['description'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['created_at'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted text-center">{{ $fields['administrators'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted text-center">{{ $fields['locked'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted text-center">{{ $fields['status'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted text-right">{{ $fields['actions'] }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td class="small">{{ $role->name }}</td>
                        <td class="small">{{ $role->description }}</td>
                        <td class="small text-muted">{{ $role->created_at }}</td>
                        <td class="text-center">{{ arcanesoft\ui\count_pill($role->administrators_count) }}</td>
                        <td class="text-center">
                            <span class="status {{ $role->isLocked() ? 'bg-danger' : 'bg-secondary' }}"
                                  data-toggle="tooltip" data-placement="top" title="@lang($role->isLocked() ? 'Locked' : 'Unlocked')"></span>
                        </td>
                        <td class="text-center">
                            <span class="status {{ $role->isActive() ? 'status-animated bg-success' : 'bg-secondary' }}"
                                  data-toggle="tooltip" data-placement="top" title="@lang($role->isActive() ? 'Activated' : 'Deactivated')"></span>
                        </td>
                        <td>
                            <div class="input-group justify-content-end">
                                {{-- SHOW --}}
                                @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('show'), [$role])
                                    <a href="{{ route('admin::auth.roles.show', [$role]) }}"
                                       class="btn btn-sm btn-light" data-toggle="tooltip" title="@lang('Show')">
                                        <i class="far fa-fw fa-eye"></i>
                                    </a>
                                @endcan

                                {{-- DROPDOWN --}}
                                <button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-fw fa-ellipsis-v"></i> <span class="sr-only">@lang('Toggle Dropdown')</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        {{-- UPDATE --}}
                                        @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('update'), [$role])
                                            <a class="dropdown-item" href="{{ route('admin::auth.roles.show', [$role]) }}">
                                                @lang('Edit')
                                            </a>
                                        @else
                                            <button class="dropdown-item disabled" tabindex="-1" aria-disabled="true">
                                                @lang('Edit')
                                            </button>
                                        @endcan
                                    </li>
                                    <li>
                                        {{-- ACTIVATE --}}
                                        @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('activate'), [$role])
                                            <button class="dropdown-item"
                                                    onclick="Foundation.$emit('auth::roles.activate', {id: '{{ $role->getRouteKey() }}', status: '{{ $role->isActive() ? 'activated' : 'deactivated' }}'})">
                                                @lang($role->isActive() ? 'Deactivate' : 'Activate')
                                            </button>
                                        @else
                                            <button class="dropdown-item disabled" tabindex="-1" aria-disabled="true">
                                                @lang($role->isActive() ? 'Deactivate' : 'Activate')
                                            </button>
                                        @endcan
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        {{-- DELETE --}}
                                        @can(Arcanesoft\Foundation\Auth\Policies\RolesPolicy::ability('delete'), [$role])
                                            <button class="dropdown-item text-danger"
                                                    onclick="Foundation.$emit('auth::roles.delete', {id: '{{ $role->getRouteKey() }}' })">
                                                @lang('Delete')
                                            </button>
                                        @else
                                            <button class="dropdown-item disabled" tabindex="-1" aria-disabled="true">
                                                @lang('Delete')
                                            </button>
                                        @endcan
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer px-2">
            <x-arc:datatable-pagination :paginator="$roles"/>
        </div>
    @else
        @include('foundation::_partials.no-data-found')
    @endif
</div>
