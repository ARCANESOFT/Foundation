<x-arc:layout>
    @section('page-title')
        <i class="fas fa-fw fa-shield-alt"></i> @lang('Permissions')
    @endsection

    <v-datatable
        name="permissions-datatable"
        url="{{ route('admin::authorization.permissions.datatable') }}"/>
</x-arc:layout>
