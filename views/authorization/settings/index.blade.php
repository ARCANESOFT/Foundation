@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-cog"></i> @lang('Settings')
@endsection

@section('content')
    <div class="row row-cols-lg-3 g-3">
        <div class="col">
            <x-arc:card>
                <x-arc:card-header>@lang('Authentication')</x-arc:card-header>
                <x-arc:card-table>
                    <tr>
                        <x-arc:table-th label="Login"/>
                        <td class="text-end">
                            @if ($authentication['login']['enabled'])
                                <span class="badge border border-success text-success">@lang('Enabled')</span>
                            @else
                                <span class="badge border border-secondary text-secondary">@lang('Disabled')</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <x-arc:table-th label="Register"/>
                        <td class="text-end">
                            @if ($authentication['register']['enabled'])
                                <span class="badge border border-success text-success">@lang('Enabled')</span>
                            @else
                                <span class="badge border border-secondary text-secondary">@lang('Disabled')</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <x-arc:table-th label="Socialite"/>
                        <td class="text-end">
                            @if ($authentication['socialite']['enabled'])
                                <span class="badge border border-success text-success">@lang('Enabled')</span>
                            @else
                                <span class="badge border border-secondary text-secondary">@lang('Disabled')</span>
                            @endif
                        </td>
                    </tr>
                </x-arc:card-table>
            </x-arc:card>
        </div>

        @if ($authentication['socialite']['enabled'])
            <div class="col">
                <?php $providers = Arcanesoft\Foundation\Authorization\Socialite::getProviders(); ?>
                <x-arc:card>
                    <x-arc:card-header>@lang('Socialite')</x-arc:card-header>
                    <x-arc:card-table>
                        @foreach($providers as $provider)
                            <tr>
                                <x-arc:table-th label="{{ $provider->name }}"/>
                                <td class="text-end">
                                    @if ($provider->enabled)
                                        <span class="badge border border-success text-success">@lang('Enabled')</span>
                                    @else
                                        <span class="badge border border-secondary text-secondary">@lang('Disabled')</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </x-arc:card-table>
                </x-arc:card>
            </div>
        @endif
    </div>
@endsection
