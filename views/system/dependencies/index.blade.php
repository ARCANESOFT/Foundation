@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-user-shield"></i> @lang('System') <small>@lang('Dependencies')</small>
@endsection

@push('content-nav')
    @include('foundation::system._includes.system-nav')
@endpush

@section('content')
    <v-datatable
        name="dependencies-datatable"
        url="{{ route('admin::system.dependencies.datatable') }}"/>
@endsection
