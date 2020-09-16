<?php
/**
 * @var  Illuminate\Pagination\LengthAwarePaginator|Arcanesoft\Foundation\Auth\Models\User[]  $users
 * @var  array                                                                                $fields
 */
?>

<div class="card card-borderless shadow-sm">
    @if ($users->isNotEmpty())
        <div class="card-header px-2">
            @include('foundation::_components.datatable.datatable-header')
        </div>
        <table class="table table-borderless table-hover mb-0">
            <thead>
                <tr>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['avatar'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['first_name'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['last_name'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['email'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['created_at'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted text-center">{{ $fields['status'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted text-right">{{ $fields['actions'] }}</th>
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
                        <td>
                            <div class="input-group justify-content-end">
                                {{-- SHOW --}}
                                @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('show'), [$user])
                                <a href="{{ route('admin::auth.users.show', [$user]) }}"
                                   class="btn btn-sm btn-light" data-toggle="tooltip" data-original-title="@lang('Show')">
                                    <i class="far fa-fw fa-eye"></i>
                                </a>
                                @endcan

                                {{-- DROPDOWN --}}
                                <button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-fw fa-ellipsis-h"></i> <span class="sr-only">@lang('Toggle Dropdown')</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    {{-- UPDATE --}}
                                    @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('update'), [$user])
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin::auth.users.edit', [$user]) }}">@lang('Edit')</a>
                                        </li>
                                    @endcan

                                    {{-- ACTIVATE --}}
                                    @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('activate'), [$user])
                                        <li>
                                            <button class="dropdown-item"
                                                    onclick="Foundation.$emit('auth::users.activate', {id: '{{ $user->getRouteKey() }}', status: '{{ $user->isActive() ? 'activated' : 'deactivated' }}'})">
                                                @lang($user->isActive() ? 'Deactivate' : 'Activate')
                                            </button>
                                        </li>
                                    @endcan

                                    {{-- RESTORE --}}
                                    @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('restore'), [$user])
                                        <li>
                                            <button class="dropdown-item"
                                                    onclick="Foundation.$emit('auth::users.restore', {id: '{{ $user->getRouteKey() }}' })">
                                                @lang('Restore')
                                            </button>
                                        </li>
                                    @endcan

                                    <li><hr class="dropdown-divider"></li>

                                    {{-- DELETE --}}
                                    @can(Arcanesoft\Foundation\Auth\Policies\UsersPolicy::ability('delete'), [$user])
                                        <li>
                                            <button class="dropdown-item text-danger"
                                                    onclick="Foundation.$emit('auth::users.delete', {id: '{{ $user->getRouteKey() }}' })">
                                                @lang('Delete')
                                            </button>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer px-2">
            @include('foundation::_components.datatable.datatable-footer', ['paginator' => $users])
        </div>
    @else
        @include('foundation::_partials.no-data-found')
    @endif
</div>
