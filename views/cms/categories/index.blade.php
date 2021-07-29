<?php /** @var  bool  $trash */ ?>
<x-arc:layout>
    @section('page-title')
        <i class="fa fa-fw fa-categories"></i> @lang('Categories')
    @endsection

    @push('content-nav')
        <nav class="page-actions">
            @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('metrics'))
                <a href="{{ route('admin::cms.categories.metrics') }}"
                   class="btn btn-sm btn-secondary {{ active(['admin::cms.categories.metrics']) }}">@lang('Metrics')</a>
            @endcan

            @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('index'))
                <a href="{{ route('admin::cms.categories.index') }}"
                   class="btn btn-sm btn-secondary {{ active(['admin::cms.categories.index']) }}">@lang('List')</a>
            @endcan

            @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('create'))
                <a href="{{ route('admin::cms.categories.create') }}"
                   class="btn btn-primary btn-sm"><i class="fa fa-fw fa-plus"></i> @lang('Add')</a>
            @endcan
        </nav>
    @endpush

    <v-datatable
        name="categories-datatable"
        url="{{ route('admin::cms.categories.datatable') }}"/>

    @push('scripts')
        <script>
            const categoriesDatatable = components.datatable('categories-datatable')
        </script>
    @endpush

    {{-- DELETE MODAL/SCRIPT --}}
    @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('delete'))
        @push('modals')
            <x-arc:modal-action
                type="delete"
                action="{{ route('admin::cms.categories.delete', [':id']) }}" method="DELETE"
                title="Delete Category"
                body="Are you sure you want to delete this category ?"
            />
        @endpush

        @push('scripts')
            <script>
                let deleteModal  = components.modal('div#delete-modal')
                let deleteForm   = components.form('form#delete-form')
                let deleteAction = deleteForm.action()

                ARCANESOFT.on('authorization::categories.delete', ({id}) => {
                    deleteForm.action(deleteAction.replace(':id', id))
                    deleteModal.show()
                })

                deleteForm.onSubmit('DELETE', () => {
                    deleteModal.hide()
                    categoriesDatatable.reload()
                })

                deleteModal.on('hidden', () => {
                    deleteForm.action(deleteAction.toString())
                })
            </script>
        @endpush
    @endcan

    {{-- RESTORE MODAL/SCRIPT --}}
    @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('restore'))
        @push('modals')
            <x-arc:modal-action
                type="restore"
                action="{{ route('admin::cms.categories.restore', [':id']) }}" method="PUT"
                title="Restore Category"
                body="Are you sure you want to restore this category ?"
            />
        @endpush

        @push('scripts')
            <script defer>
                let restoreModal = components.modal('div#restore-modal')
                let restoreForm = components.form('form#restore-form')
                let restoreAction = restoreForm.action()

                ARCANESOFT.on('authorization::categories.restore', ({id}) => {
                    restoreForm.action(restoreAction.replace(':id', id))
                    restoreModal.show()
                })

                restoreForm.onSubmit('PUT', () => {
                    restoreModal.hide()
                    categoriesDatatable.reload()
                })

                restoreModal.on('hidden', () => {
                    restoreForm.action(restoreAction.toString())
                })
            </script>
        @endpush
    @endcan
</x-arc:layout>
