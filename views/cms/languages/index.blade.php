@extends(arcanesoft\foundation()->template())

<?php /** @var  bool  $trash */ ?>

@section('page-title')
    <i class="fa fa-fw fa-language"></i> @lang('Languages')
@endsection

@push('content-nav')
    <nav class="page-actions">
        @can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('metrics'))
            <a href="{{ route('admin::cms.languages.metrics') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::cms.languages.metrics']) }}">@lang('Metrics')</a>
        @endcan

        @can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('index'))
            <a href="{{ route('admin::cms.languages.index') }}"
               class="btn btn-sm btn-secondary {{ active(['admin::cms.languages.index']) }}">@lang('List')</a>
        @endcan

        @can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('create'))
            <a href="{{ route('admin::cms.languages.create') }}"
               class="btn btn-primary btn-sm"><i class="fa fa-fw fa-plus"></i> @lang('Add')</a>
        @endcan
    </nav>
@endpush

@section('content')
    <v-datatable
        name="languages-datatable"
        url="{{ route('admin::cms.languages.datatable') }}"/>
@endsection

@push('scripts')
    <script>
        const languagesDatatable = components.datatable('languages-datatable')
    </script>
@endpush

{{-- DELETE MODAL/SCRIPT --}}
@can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('delete'))
    @push('modals')
        <x-arc:modal-action
            type="delete"
            action="{{ route('admin::cms.languages.delete', [':id']) }}" method="DELETE"
            title="Delete Category"
            body="Are you sure you want to delete this category ?"
        />
    @endpush

    @push('scripts')
        <script>
            let deleteModal  = components.modal('div#delete-modal')
            let deleteForm   = components.form('form#delete-form')
            let deleteAction = deleteForm.action()

            ARCANESOFT.on('authorization::languages.delete', ({id}) => {
                deleteForm.action(deleteAction.replace(':id', id))
                deleteModal.show()
            })

            deleteForm.onSubmit('DELETE', () => {
                deleteModal.hide()
                languagesDatatable.reload()
            })

            deleteModal.on('hidden', () => {
                deleteForm.action(deleteAction.toString())
            })
        </script>
    @endpush
@endcan
