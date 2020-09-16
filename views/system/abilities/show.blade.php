@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-user-shield"></i> @lang('Abilities')
@endsection

<?php /** @var  Arcanedev\LaravelPolicies\Ability  $ability */ ?>

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-borderless shadow-sm">
                <div class="card-header">@lang('Ability')</div>
                <table class="table table-hover mb-0">
                    <tbody>
                        <tr>
                            <th>@lang('Key') :</th>
                            <td class="text-right">
                                <span class="badge badge-outline-dark">{{ $ability->key() }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('Method') :</th>
                            <td class="text-right">
                                <code>{{ $ability->isClosure() ? 'Closure' : $ability->method() }}</code>
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('Category') :</th>
                            <td class="text-right">{{ $ability->meta('category') }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Name') :</th>
                            <td class="text-right">{{ $ability->meta('name') }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Description') :</th>
                            <td class="text-right">{{ $ability->meta('description') }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Registered') :</th>
                            <td class="text-right">
                                @if ($ability->meta('is_registered', false))
                                    <span class="badge badge-outline-success">@lang('Yes')</span>
                                @else
                                    <span class="badge badge-outline-secondary">@lang('No')</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                @can(Arcanesoft\Foundation\System\Policies\AbilitiesPolicy::ability('index'))
                <div class="card-footer text-right px-2">
                    <a href="{{ route('admin::system.abilities.index') }}" class="btn btn-sm btn-light">
                        @lang('Return back')
                    </a>
                </div>
                @endcan
            </div>
        </div>
    </div>
@endsection
