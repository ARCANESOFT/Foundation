@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-user-tag"></i> @lang('Roles') <small>@lang('Metrics')</small>
@endsection

@push('content-nav')
    @include('foundation::authorization.roles._partials.nav-actions')
@endpush

@section('content')
@endsection
