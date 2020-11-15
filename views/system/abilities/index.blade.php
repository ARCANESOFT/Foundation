@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-user-shield"></i> @lang('System') <small>@lang('Abilities')</small>
@endsection

@push('content-nav')
    @include('foundation::system._includes.system-nav')
@endpush

@section('content')
    <v-datatable
        name="abilities-datatable"
        url="{{ route('admin::system.abilities.datatable') }}"/>
@endsection
