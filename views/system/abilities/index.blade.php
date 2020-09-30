@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-user-shield"></i> @lang('System') <small>@lang('Abilities')</small>
@endsection

@section('content')
    @include('foundation::system._includes.system-nav')

    <v-datatable name="{{ Arcanesoft\Foundation\System\Views\Components\AbilitiesDatatable::NAME }}"/>
@endsection
