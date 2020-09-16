@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-sync"></i> @lang('Password Resets')
@endsection

@push('content-nav')
    <div class="mb-3 text-right">
        @can(Arcanesoft\Foundation\Auth\Policies\PasswordResetsPolicy::ability('metrics'))
        <a href="{{ route('admin::auth.password-resets.metrics') }}" class="btn btn-sm btn-secondary {{ active(['admin::auth.password-resets.metrics']) }}">@lang('Metrics')</a>
        @endcan

        @can(Arcanesoft\Foundation\Auth\Policies\PasswordResetsPolicy::ability('index'))
        <a href="{{ route('admin::auth.password-resets.index') }}" class="btn btn-sm btn-secondary {{ active(['admin::auth.password-resets.index']) }}">@lang('All')</a>
        @endcan
    </div>
@endpush

@section('content')
    <v-datatable name="{{ Arcanesoft\Foundation\Auth\Views\Components\PasswordResetsDatatable::NAME }}"></v-datatable>
@endsection
