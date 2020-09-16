@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-shield-alt"></i> @lang('Permissions')
@endsection

@section('content')
    <v-datatable name="{{ Arcanesoft\Foundation\Auth\Views\Components\PermissionsDatatable::NAME }}"></v-datatable>
@endsection
