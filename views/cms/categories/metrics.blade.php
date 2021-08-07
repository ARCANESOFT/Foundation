<x-arc:layout>
    @section('page-title')
        <i class="fas fa-fw fa-stream"></i> @lang('Categories') <small>@lang('Metrics')</small>
    @endsection

    @push('content-nav')
        @include('foundation::cms.categories._partials.nav-actions')
    @endpush
</x-arc:layout>
