@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-cog"></i> @lang('Settings')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-borderless shadow-sm mb-3">
                <div class="card-header">@lang('Authentication')</div>
                <table class="table table-borderless table-hover mb-0">
                    <tr>
                        <td class="font-weight-light text-uppercase text-muted">@lang('Login')</td>
                        <td class="text-right">
                            @if ($authentication['login']['enabled'])
                                <span class="badge border border-success text-success">@lang('Enabled')</span>
                            @else
                                <span class="badge border border-secondary text-secondary">@lang('Disabled')</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-light text-uppercase text-muted">@lang('Register')</td>
                        <td class="text-right">
                            @if ($authentication['register']['enabled'])
                                <span class="badge border border-success text-success">@lang('Enabled')</span>
                            @else
                                <span class="badge border border-secondary text-secondary">@lang('Disabled')</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-light text-uppercase text-muted">Socialite</td>
                        <td class="text-right">
                            @if ($authentication['socialite']['enabled'])
                                <span class="badge border border-success text-success">@lang('Enabled')</span>
                            @else
                                <span class="badge border border-secondary text-secondary">@lang('Disabled')</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            @if ($authentication['socialite']['enabled'])
                <?php $providers = Arcanesoft\Foundation\Auth\Socialite::getProviders(); ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-header">Socialite</div>
                    <table class="table table-borderless mb-0">
                        @foreach($providers as $provider)
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">{{ $provider->name }}</td>
                            <td class="text-right">
                                @if ($provider->enabled)
                                    <span class="badge border border-success text-success">@lang('Enabled')</span>
                                @else
                                    <span class="badge border border-secondary text-secondary">@lang('Disabled')</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
