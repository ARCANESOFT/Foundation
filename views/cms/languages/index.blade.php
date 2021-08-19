<?php /** @var  bool  $trash */ ?>
<x-arc:layout>
    @section('page-title')
        <i class="fa fa-fw fa-language"></i> @lang('Languages')
    @endsection

    @push('content-nav')
        @include('foundation::cms.languages._partials.nav-actions')
    @endpush

    <v-datatable
        name="languages-datatable"
        url="{{ route('admin::cms.languages.datatable') }}"/>

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
</x-arc:layout>
