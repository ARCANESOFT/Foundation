@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-users"></i> @lang('Categories') <small>@lang('New Category')</small>
@endsection

@section('content')
    <x-arc:form action="{{ route('admin::cms.categories.store') }}" method="POST">
        <div class="row row-cols-lg-2">
            <div class="col">
                <x-arc:card>
                    <x-arc:card-header>@lang('Category')</x-arc:card-header>
                    <x-arc:card-body>
                        <div class="row g-3">
                            {{-- NAME --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:input-control
                                    type="text" name="name" :value="old('name')"
                                    label="Name" required/>
                            </div>

                            {{-- SLUG --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:input-control
                                    type="text" name="slug" :value="old('slug')"
                                    label="Slug" required/>
                            </div>

                            {{-- DESCRIPTION --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:input-control
                                    type="text" name="description" :value="old('description')"
                                    label="Description"/>
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
                        {{-- NAME --}}
                        <div class="col-12 col-xxl-6">
                            <x-arc:input-control
                                type="text" name="parent" :value="old('parent')"
                                label="Parent"/>
                        </div>
                    </x-arc:card-body>
                </x-arc:card>
            </div>
        </div>
    </x-arc:form>
@endsection
