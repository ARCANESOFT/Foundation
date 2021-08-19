<?php
/**
 * @var  Arcanesoft\Foundation\Cms\Models\Category|mixed       $category
 * @var  Arcanesoft\Foundation\Cms\Models\Category|mixed|null  $parentCategory
 * @var  Arcanesoft\Foundation\Cms\Models\Category[]|mixed     $subCategories
 */
?>
<x-arc:layout>
    @section('page-title')
        <i class="far fa-fw fa-categories"></i> @lang('Categories') <small>@lang("Category's details")</small>
    @endsection

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="row row-cols-1 g-4">
                {{-- Category --}}
                <div class="col">
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
                        <x-arc:card-footer class="d-flex justify-content-end btn-separated">
                            {{-- UPDATE --}}
                            @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('update'), [$category])
                                <x-arc:button-action
                                    type="edit" action="{{ route('admin::cms.categories.edit', [$category]) }}"/>
                            @endcan

                            {{-- ACTIVATE --}}
                            @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('activate'), [$category])
                                <x-arc:button-action
                                    type="activate" action="cms::categories.activate"/>
                            @endcan

                            {{-- DEACTIVATE --}}
                            @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('deactivate'), [$category])
                                <x-arc:button-action
                                    type="deactivate" action="cms::categories.deactivate"/>
                            @endcan

                            {{-- RESTORE --}}
                            @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('restore'), [$category])
                                <x-arc:button-action
                                    type="restore" action="cms::categories.restore"/>
                            @endcan

                            {{-- DELETE --}}
                            @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('delete'), [$category])
                                <x-arc:button-action
                                    type="delete" action="cms::categories.delete"/>
                            @endcan
                        </x-arc:card-footer>
                    </x-arc:card>
                </div>

                {{-- Parent --}}
                @if($parentCategory)
                <div class="col">
                    <x-arc:card>
                        <x-arc:card-header>@lang('Parent')</x-arc:card-header>
                        <x-arc:card-table>
                            <tbody>
                            <tr>
                                <x-arc:table-th label="Slug"/>
                                <td class="text-end small">{{ $parentCategory->slug }}</td>
                            </tr>
                            <tr>
                                <x-arc:table-th label="Created at"/>
                                <td class="text-end text-muted small">{{ $parentCategory->created_at }}</td>
                            </tr>
                            <tr>
                                <x-arc:table-th label="Updated at"/>
                                <td class="text-end text-muted small">{{ $parentCategory->updated_at }}</td>
                            </tr>
                            @if ($parentCategory->trashed())
                                <tr>
                                    <x-arc:table-th label="Deleted at"/>
                                    <td class="font-weight-light text-uppercase text-muted">@lang('Deleted at')</td>
                                    <td class="text-end text-muted small">{{ $parentCategory->deleted_at }}</td>
                                </tr>
                            @endif
                            </tbody>
                        </x-arc:card-table>
                        <x-arc:card-footer class="d-flex justify-content-end">
                            {{-- UPDATE --}}
                            @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('show'), [$parentCategory])
                                <x-arc:button-action
                                    type="show" action="{{ route('admin::cms.categories.show', [$parentCategory]) }}"/>
                            @endcan
                        </x-arc:card-footer>
                    </x-arc:card>
                </div>
                @endif
            </div>
        </div>
        <div class="col-lg-7">
            {{-- Children --}}
            <x-arc:card>
                <x-arc:card-header>@lang('Sub-categories')</x-arc:card-header>
                <x-arc:card-table class="table-hover">
                    <thead>
                    <tr>
                        <x-arc:table-th label="Name"/>
                        <x-arc:table-th label="Description"/>
                        <x-arc:table-th label="Sub-categories" class="text-center"/>
                        <x-arc:table-th label="Actions" class="text-end"/>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($subCategories as $subCategory)
                        <tr>
                            <td class="small">{{ $subCategory->name }}</td>
                            <td class="small">{{ $subCategory->description }}</td>
                            <td class="text-center">
                                <x-arc:badge-count :value="$subCategory->children_count"/>
                            </td>
                            <td class="text-end">
                                <x-arc:table-action
                                    type="Show" action="{{ route('admin::cms.categories.show', [$subCategory]) }}"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-muted text-center">@lang('The list is empty !')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </x-arc:card-table>
            </x-arc:card>
        </div>
    </div>

    {{-- ACIVATE MODAL --}}
    @can(Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy::ability('activate'), [$category])
        @push('modals')
            <x-arc:modal-action
                type="activate"
                action="{{ route('admin::cms.categories.activate', [$category]) }}" method="PUT"
                title="Activate Category" body="Are you sure you want to activate this category ?"
            />
        @endpush

        @push('scripts')
            <script defer>
                let activateModal = components.modal('div#activate-modal')
                let activateForm  = components.form('form#activate-form')

                ARCANESOFT.on('cms::categories.activate', () => {
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
                title="Deactivate Category" body="Are you sure you want to deactivate this category ?"
            />
        @endpush

        @push('scripts')
            <script defer>
                let deactivateModal = components.modal('div#deactivate-modal')
                let deactivateForm  = components.form('form#deactivate-form')

                ARCANESOFT.on('cms::categories.deactivate', () => {
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
                title="Delete Category"
                body="Are you sure you want to delete this category ?"
            />
        @endpush

        @push('scripts')
            <script defer>
                let deleteModal = components.modal('div#delete-modal')
                let deleteForm  = components.form('form#delete-form')

                ARCANESOFT.on('cms::categories.delete', () => {
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
