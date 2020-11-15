@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-info-circle"></i> @lang('System') <small>@lang('Information')</small>
@endsection

@push('content-nav')
    @include('foundation::system._includes.system-nav')
@endpush

@section('content')
    <div class="row g-4">
        <div class="col-lg-4">
            @include(Arcanesoft\Foundation\System\Views\Composers\ApplicationInfoComposer::VIEW)
        </div>
        <div class="col-lg-4">
            @include(Arcanesoft\Foundation\System\Views\Composers\FoldersPermissionsComposer::VIEW)
        </div>
        <div class="col-lg-4">
            @include(Arcanesoft\Foundation\System\Views\Composers\RequiredPhpExtensionsComposer::VIEW)
        </div>
    </div>
@endsection

@section('scripts')
@endsection
