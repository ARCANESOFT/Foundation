<?php
/**
 * @var  Illuminate\Pagination\LengthAwarePaginator|Arcanesoft\Foundation\Auth\Models\Permission[]  $permissions
 * @var  array                                                                                      $fields
 */
?>

<div class="card card-borderless shadow-sm">
    @if ($permissions->isNotEmpty())
        <div class="card-header px-2">
            @include('foundation::_components.datatable.datatable-header')
        </div>
        <div class="table-responsive">
            <table class="table table-borderless table-hover table-md mb-0">
                <thead>
                <tr>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['group'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['category'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['name'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['description'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted text-center">{{ $fields['roles'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted text-right">{{ $fields['actions'] }}</th>
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
                            {{ arcanesoft\ui\count_pill($permission->roles_count) }}
                        </td>
                        <td class="text-right">
                            @can(Arcanesoft\Foundation\Auth\Policies\PermissionsPolicy::ability('show'), [$permission])
                                <a href="{{ route('admin::auth.permissions.show', [$permission]) }}"
                                   class="btn btn-sm btn-light" data-toggle="tooltip" title="@lang('Show')">
                                    <i class="far fa-fw fa-eye"></i>
                                </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer px-2">
            @include('foundation::_components.datatable.datatable-footer', ['paginator' => $permissions])
        </div>
    @else
        @include('foundation::_partials.no-data-found')
    @endif
</div>
