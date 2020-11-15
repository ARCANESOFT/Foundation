@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-shield-alt"></i> @lang('Permissions')
@endsection

@section('content')
    <v-datatable
        name="permissions-datatable"
        url="{{ route('admin::authorization.permissions.datatable') }}"/>
@endsection
