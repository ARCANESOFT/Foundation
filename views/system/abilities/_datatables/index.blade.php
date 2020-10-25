<?php
/**
 * @var  Arcanedev\LaravelPolicies\Ability[]|Illuminate\Contracts\Pagination\LengthAwarePaginator  $abilities
 * @var  array                                                                                     $fields
 */
?>
<x-arc:card>
    @if ($abilities->isNotEmpty())
        <x-arc:card-header>
            @include('foundation::_includes.datatable.datatable-header')
        </x-arc:card-header>
        <x-arc:card-table>
            <thead>
                <tr>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['key'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['name'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['description'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted text-center">{{ $fields['registered'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted text-right">{{ $fields['actions'] }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($abilities as $key => $ability)
                <tr>
                    <td>
                        <span class="badge border border-muted text-muted">{{ $ability->key() }}</span>
                    </td>
                    <td class="small">{{ $ability->meta('name', '') }}</td>
                    <td class="small">
                        {{ $ability->meta('description', '') }}
                    </td>
                    <td class="text-center">
                        @if ($ability->meta('is_registered', false))
                            <span class="status status-animated bg-success"
                                  data-toggle="tooltip" title="@lang('Yes')"></span>
                        @else
                            <span class="status bg-secondary"
                                  data-toggle="tooltip" title="@lang('No')"></span>
                        @endif
                    </td>
                    <td class="text-right">
                        @can(Arcanesoft\Foundation\System\Policies\AbilitiesPolicy::ability('show'))
                            <a href="{{ route('admin::system.abilities.show', $ability->key()) }}"
                               class="btn btn-sm btn-light">
                                <i class="far fa-fw fa-eye"></i>
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </x-arc:card-table>
        <x-arc:card-footer>
            @include('foundation::_includes.datatable.datatable-footer', ['paginator' => $abilities])
        </x-arc:card-footer>
    @else
        @include('foundation::_partials.no-data-found')
    @endif
</x-arc:card>
