<?php
/**
 * @var  Illuminate\Contracts\Pagination\LengthAwarePaginator  $packages
 * @var  array                                                 $fields
 */
?>
<div class="card card-borderless shadow-sm">
    @if ($packages->isNotEmpty())
        <div class="card-header px-2">
            @include('foundation::_components.datatable.datatable-header')
        </div>
        <table class="table table-borderless table-hover mb-0">
            <thead>
            <tr>
                <th class="font-weight-light text-uppercase text-muted">{{ $fields['name'] }}</th>
                <th class="font-weight-light text-uppercase text-muted">{{ $fields['description'] }}</th>
                <th class="font-weight-light text-uppercase text-muted text-center">{{ $fields['version'] }}</th>
                <th class="font-weight-light text-uppercase text-muted text-right">{{ $fields['actions'] }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($packages as $package)
                <tr>
                    <td>
                        <span class="badge border border-muted text-muted">{{ $package['name'] }}</span>
                    </td>
                    <td class="small">{{ $package['description'] }}</td>
                    <td class="text-center small">{{ $package['version'] }}</td>
                    <td class="text-right">
                        @can(Arcanesoft\Foundation\System\Policies\DependenciesPolicy::ability('show'))
                            <a href="{{ route('admin::system.dependencies.show', $package['key']) }}"
                               class="btn btn-sm btn-light">
                                <i class="far fa-fw fa-eye"></i>
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="card-footer px-2">
            @include('foundation::_components.datatable.datatable-footer', ['paginator' => $packages])
        </div>
    @else
        @include('foundation::_partials.no-data-found')
    @endif
</div>
