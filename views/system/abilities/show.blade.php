@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-user-shield"></i> @lang('Abilities')
@endsection

<?php /** @var  Arcanedev\LaravelPolicies\Ability  $ability */ ?>

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <x-arc:card>
                <x-arc:card-header>@lang('Ability')</x-arc:card-header>
                <x-arc:card-table>
                    <tbody>
                        <tr>
                            <th class="font-weight-light text-uppercase text-muted">@lang('Key')</th>
                            <td class="text-right">
                                <span class="badge border border-muted text-muted">{{ $ability->key() }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="font-weight-light text-uppercase text-muted">@lang('Method')</th>
                            <td class="text-right font-monospace small">
                                @if($ability->isClosure())
                                    Closure
                                @else
                                    @php([$class, $method] = explode('@', $ability->method()))
                                    <abbr title="{{ $ability->method() }}">{{ class_basename($class).'@'.$method }}</abbr>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="font-weight-light text-uppercase text-muted">@lang('Category')</th>
                            <td class="text-right small">{{ $ability->meta('category') }}</td>
                        </tr>
                        <tr>
                            <th class="font-weight-light text-uppercase text-muted">@lang('Name')</th>
                            <td class="text-right small">{{ $ability->meta('name') }}</td>
                        </tr>
                        <tr>
                            <th class="font-weight-light text-uppercase text-muted">@lang('Description')</th>
                            <td class="text-right small">{{ $ability->meta('description') }}</td>
                        </tr>
                        <tr>
                            <th class="font-weight-light text-uppercase text-muted">@lang('Registered')</th>
                            <td class="text-right">
                                @if ($ability->meta('is_registered', false))
                                    <span class="badge border border-success text-success">@lang('Yes')</span>
                                @else
                                    <span class="badge border border-secondary text-secondary">@lang('No')</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </x-arc:card-table>
                @can(Arcanesoft\Foundation\System\Policies\AbilitiesPolicy::ability('index'))
                <x-arc:card-footer class="text-right">
                    <a href="{{ route('admin::system.abilities.index') }}"
                       class="btn btn-sm btn-light">@lang('Return back')</a>
                </x-arc:card-footer>
                @endcan
            </x-arc:card>
        </div>
    </div>
@endsection
