<x-arc:layout>
    @section('page-title')
        <i class="fas fa-fw fa-sync"></i> @lang('Password Resets')
    @endsection

    @push('content-nav')
        <nav class="page-actions">
            @can(Arcanesoft\Foundation\Authorization\Policies\PasswordResetsPolicy::ability('metrics'))
            <a href="{{ route('admin::authorization.password-resets.metrics') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::authorization.password-resets.metrics']) }}">@lang('Metrics')</a>
            @endcan

            @can(Arcanesoft\Foundation\Authorization\Policies\PasswordResetsPolicy::ability('index'))
            <a href="{{ route('admin::authorization.password-resets.index') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::authorization.password-resets.index']) }}">@lang('List')</a>
            @endcan
        </nav>
    @endpush

    <v-datatable
        name="password-resets-datatable"
        url="{{ route('admin::authorization.password-resets.datatable') }}"/>
</x-arc:layout>
