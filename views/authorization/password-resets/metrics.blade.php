<x-arc:layout>
    @section('page-title')
        <i class="fas fa-fw fa-sync"></i> @lang('Password Resets') <small>@lang('Metrics')</small>
    @endsection

    @push('content-nav')
        <nav class="page-actions">
            @can(Arcanesoft\Foundation\Authorization\Policies\PasswordResetsPolicy::ability('metrics'))
            <a href="{{ route('admin::authorization.password-resets.metrics') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::authorization.password-resets.metrics']) }}">@lang('Metrics')</a>
            @endcan

            @can(Arcanesoft\Foundation\Authorization\Policies\PasswordResetsPolicy::ability('index'))
            <a href="{{ route('admin::authorization.password-resets.index') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::authorization.password-resets.index']) }}">@lang('Password Resets')</a>
            @endcan
        </nav>
    @endpush
</x-arc:layout>
