<x-arc:layout>
    @section('page-title')
        <i class="fa fa-fw fa-user-secret"></i> @lang('Administrators') <small>@lang('Metrics')</small>
    @endsection

    @push('content-nav')
        @include('foundation::authorization.administrators._partials.nav-actions')
    @endpush
</x-arc:layout>
