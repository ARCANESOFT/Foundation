<?php
/**
 * @var  Arcanesoft\Foundation\Auth\Models\Administrator[]|Illuminate\Pagination\LengthAwarePaginator  $administrators
 * @var  array                                                                                         $fields
 */
?>

<div class="card card-borderless shadow-sm">
    @if ($administrators->isNotEmpty())
        <div class="card-header px-2">
            @include('foundation::_components.datatable.datatable-header')
        </div>
        <table class="table table-borderless table-hover mb-0">
            <thead>
                <tr>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['first_name'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['last_name'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['email'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['created_at'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted text-center">{{ $fields['status'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted text-right">{{ $fields['actions'] }}</th>
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
                            <span class="status {{ $administrator->isActive() ? 'bg-success status-animated' : 'bg-secondary' }}"
                                  data-toggle="tooltip" data-placement="top" title="@lang($administrator->isActive() ? 'Activated' : 'Deactivated')"></span>
                        </td>
                        <td>
                            <div class="input-group justify-content-end">
                                {{-- SHOW --}}
                                @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('show'), [$administrator])
                                    <a href="{{ route('admin::auth.administrators.show', [$administrator]) }}"
                                       class="btn btn-sm btn-light" data-toggle="tooltip" title="@lang('Show')">
                                        <i class="far fa-fw fa-eye"></i>
                                    </a>
                                @else
                                    <button class="btn btn-sm btn-light disabled" tabindex="-1" aria-disabled="true" data-toggle="tooltip" title="@lang('Show')">
                                        <i class="far fa-fw fa-eye"></i>
                                    </button>
                                @endcan

                                {{-- DROPDOWN --}}
                                <button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-fw fa-ellipsis-v"></i> <span class="sr-only">@lang('Toggle Dropdown')</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    {{-- UPDATE --}}
                                    <li>
                                        @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('update'), [$administrator])
                                            <a class="dropdown-item" href="{{ route('admin::auth.administrators.edit', [$administrator]) }}">@lang('Edit')</a>
                                        @else
                                            <button class="dropdown-item disabled" tabindex="-1" aria-disabled="true">
                                                @lang('Edit')
                                            </button>
                                        @endcan
                                    </li>

                                    {{-- ACTIVATE --}}
                                    <li>
                                        @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('activate'), [$administrator])
                                            <button class="dropdown-item"
                                                    onclick="Foundation.$emit('authorization::administrators.activate', {id: '{{ $administrator->getRouteKey() }}', status: '{{ $administrator->isActive() ? 'activated' : 'deactivated' }}'})">
                                                @lang($administrator->isActive() ? 'Deactivate' : 'Activate')
                                            </button>
                                        @else
                                            <button class="dropdown-item disabled" tabindex="-1" aria-disabled="true">
                                                @lang($administrator->isActive() ? 'Deactivate' : 'Activate')
                                            </button>
                                        @endcan
                                    </li>

                                    {{-- RESTORE --}}
                                    @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('restore'), [$administrator])
                                        <li>
                                            <button class="dropdown-item"
                                                    onclick="Foundation.$emit('authorization::administrators.restore', {id: '{{ $administrator->getRouteKey() }}' })">
                                                @lang('Restore')
                                            </button>
                                        </li>
                                    @endcan

                                    <li><hr class="dropdown-divider"></li>

                                    {{-- DELETE --}}
                                    <li>
                                        @can(Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::ability('delete'), [$administrator])
                                            <button class="dropdown-item text-danger"
                                                    onclick="Foundation.$emit('authorization::administrators.delete', {id: '{{ $administrator->getRouteKey() }}' })">
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
            @include('foundation::_components.datatable.datatable-footer', ['paginator' => $administrators])
        </div>
    @else
        @include('foundation::_partials.no-data-found')
    @endif
</div>
