<x-arc:layout>
    @section('page-title')
        <i class="fa fa-fw fa-users"></i> @lang('Users') <small>@lang('Metrics')</small>
    @endsection

    @push('content-nav')
        @include('foundation::authorization.users._partials.nav-actions')
    @endpush
</x-arc:layout>
