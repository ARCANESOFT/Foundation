<?php /** @var  Arcanesoft\Foundation\Cms\Models\Category|mixed  $category */ ?>
<x-arc:layout>
    @section('page-title')
        <i class="far fa-fw fa-categories"></i> @lang('Categories') <small>@lang("Category's details")</small>
    @endsection

    <div class="row g-4">
        <div class="col-lg-5">
            <x-arc:card>
                <x-arc:card-header>@lang('Category')</x-arc:card-header>
                <x-arc:card-table>
                    <tbody>
                        <tr>
                            <x-arc:table-th label="Slug"/>
                            <td class="text-end small">{{ $category->slug }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Created at"/>
                            <td class="text-end text-muted small">{{ $category->created_at }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Updated at"/>
                            <td class="text-end text-muted small">{{ $category->updated_at }}</td>
                        </tr>
                        @if ($category->trashed())
                            <tr>
                                <x-arc:table-th label="Deleted at"/>
                                <td class="font-weight-light text-uppercase text-muted">@lang('Deleted at')</td>
                                <td class="text-end text-muted small">{{ $category->deleted_at }}</td>
                            </tr>
                        @endif
                    </tbody>
                </x-arc:card-table>
                <x-arc:card-footer class="d-flex justify-content-end">
                    {{-- UPDATE --}}
                    @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('update'), [$category])
                        <a href="{{ route('admin::cms.categories.edit', [$category]) }}"
                           class="btn btn-sm btn-secondary">@lang('Edit')</a>
                    @endcan

                    {{-- ACTIVATE --}}
                    @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('activate'), [$category])
                        <button class="btn btn-sm btn-secondary ms-2"
                                onclick="ARCANESOFT.emit('cms::languages.activate')">@lang('Activate')</button>
                    @endcan

                    {{-- DEACTIVATE --}}
                    @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('deactivate'), [$category])
                        <button class="btn btn-sm btn-secondary ms-2"
                                onclick="ARCANESOFT.emit('cms::languages.deactivate')">@lang('Deactivate')</button>
                    @endcan

                    {{-- RESTORE --}}
                    @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('restore'), [$category])
                        <button class="btn btn-sm btn-secondary ms-2"
                                onclick="ARCANESOFT.emit('cms::languages.restore')">@lang('Restore')</button>
                    @endcan

                    {{-- DELETE --}}
                    @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('delete'), [$category])
                        <button class="btn btn-sm btn-danger ms-2"
                                onclick="ARCANESOFT.emit('cms::languages.delete')">@lang('Delete')</button>
                    @endcan
                </x-arc:card-footer>
            </x-arc:card>
        </div>
        <div class="col-lg-7">
            <x-arc:card>
                <x-arc:card-header>@lang('Sub-categories')</x-arc:card-header>
            </x-arc:card>
        </div>
    </div>

    {{-- ACIVATE MODAL --}}
    @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('activate'), [$category])
        @push('modals')
            <x-arc:modal-action
                type="activate"
                action="{{ route('admin::cms.categories.activate', [$category]) }}" method="PUT"
                title="Activate Language" body="Are you sure you want to activate this user ?"
            />
        @endpush

        @push('scripts')
            <script defer>
                let activateModal = components.modal('div#activate-modal')
                let activateForm  = components.form('form#activate-form')

                ARCANESOFT.on('cms::languages.activate', () => {
                    activateModal.show()
                });

                activateForm.onSubmit('PUT', () => {
                    activateModal.hide()
                    location.reload()
                })
            </script>
        @endpush
    @endcan

    {{-- DEACIVATE MODAL --}}
    @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('deactivate'), [$category])
        @push('modals')
            <x-arc:modal-action
                type="deactivate"
                action="{{ route('admin::cms.categories.deactivate', [$category]) }}" method="PUT"
                title="Deactivate Language" body="Are you sure you want to deactivate this user ?"
            />
        @endpush

        @push('scripts')
            <script defer>
                let deactivateModal = components.modal('div#deactivate-modal')
                let deactivateForm  = components.form('form#deactivate-form')

                ARCANESOFT.on('cms::languages.deactivate', () => {
                    deactivateModal.show()
                });

                deactivateForm.onSubmit('PUT', () => {
                    deactivateModal.hide()
                    location.reload()
                })
            </script>
        @endpush
    @endcan

    {{-- DELETE MODAL --}}
    @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('delete'), [$category])
        @push('modals')
            <x-arc:modal-action
                type="delete"
                action="{{ route('admin::cms.categories.delete', [$category]) }}" method="DELETE"
                title="Delete Language"
                body="Are you sure you want to delete this user ?"
            />
        @endpush

        @push('scripts')
            <script defer>
                let deleteModal = components.modal('div#delete-modal')
                let deleteForm  = components.form('form#delete-form')

                ARCANESOFT.on('cms::languages.delete', () => {
                    deleteModal.show()
                })

                deleteForm.onSubmit('DELETE', () => {
                    deleteModal.hide()
                    @if ($category->trashed())
                    location.replace("{{ route('admin::cms.categories.index') }}")
                    @else
                    location.reload()
                    @endif
                })
            </script>
        @endpush
    @endcan
</x-arc:layout>
