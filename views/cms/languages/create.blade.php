@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-language"></i> @lang('Languages') <small>@lang('New Language')</small>
@endsection

@section('content')
    <x-arc:form action="{{ route('admin::cms.languages.store') }}" method="POST">
        <div class="row row-cols-lg-2">
            <div class="col">
                <x-arc:card>
                    <x-arc:card-header>@lang('Language')</x-arc:card-header>
                    <x-arc:card-body>
                        <div class="row g-3">
                            {{-- NAME --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:select-control
                                    name="code" :value="old('code')" :options="$languages"
                                    label="Code" required/>
                            </div>
                        </div>
                    </x-arc:card-body>
                    <x-arc:card-footer class="d-flex justify-content-between">
                        <x-arc:form-cancel-button to="{{ route('admin::cms.languages.index') }}"/>
                        <x-arc:form-submit-button type="save"/>
                    </x-arc:card-footer>
                </x-arc:card>
            </div>
        </div>
    </x-arc:form>
@endsection
