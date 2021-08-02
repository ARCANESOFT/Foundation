<x-arc:layout>
    @section('page-title')
        <i class="fa fa-fw fa-users"></i> @lang('Categories') <small>@lang('New Category')</small>
    @endsection

    <x-arc:form action="{{ route('admin::cms.categories.store') }}">
        <div class="row row-cols-lg-2">
            <div class="col">
                <x-arc:card>
                    <x-arc:card-header>@lang('Category')</x-arc:card-header>
                    <x-arc:card-body>
                        <div class="row g-3">
                            {{-- SLUG --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:input-control
                                    type="text" name="slug" label="Slug" required/>
                            </div>
                            <div class="col-12">
                                <x-arc:localized-content>
                                    <?php /** @var  Arcanesoft\Foundation\Views\Components\Cms\LocalizedContentComponent  $component */ ?>
                                    @foreach($component->getLocales() as $locale)
                                        <x-arc:localized-content-pane :locale="$locale" :active="$loop->first">
                                            <div class="row g-3">
                                                {{-- NAME --}}
                                                <div class="col-12 col-xxl-6">
                                                    <x-arc:input-control
                                                        type="text" name="name[{{$locale}}]" label="Name" required/>
                                                </div>

                                                {{-- DESCRIPTION --}}
                                                <div class="col-12 col-xxl-6">
                                                    <x-arc:input-control
                                                        type="text" name="description[{{$locale}}]" label="Description"/>
                                                </div>
                                            </div>
                                        </x-arc:localized-content-pane>
                                    @endforeach
                                </x-arc:localized-content>
                            </div>
                        </div>
                    </x-arc:card-body>
                    <x-arc:card-footer class="d-flex justify-content-between">
                        <x-arc:form-cancel-button to="{{ route('admin::cms.categories.index') }}"/>
                        <x-arc:form-submit-button type="save"/>
                    </x-arc:card-footer>
                </x-arc:card>
            </div>
            <div class="col">
                <x-arc:card>
                    <x-arc:card-header>@lang('Parent')</x-arc:card-header>
                    <x-arc:card-body>
                        {{-- PARENT CATEGORY --}}
                        <div class="col-12 col-xxl-6">
                            <x-arc:input-control
                                type="text" name="parent" label="Parent"/>
                        </div>
                    </x-arc:card-body>
                </x-arc:card>
            </div>
        </div>
    </x-arc:form>
</x-arc:layout>
