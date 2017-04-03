@section('header')
    <i class="fa fa-fw fa-info-circle"></i> System <small>Information</small>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include(Arcanesoft\Foundation\ViewComposers\System\ApplicationInfoComposer::VIEW)
        </div>
        <div class="col-md-4">
            @include(Arcanesoft\Foundation\ViewComposers\System\ServerRequirementsComposer::VIEW)
        </div>
        <div class="col-md-4">
            @include(Arcanesoft\Foundation\ViewComposers\System\FoldersPermissionsComposer::VIEW)
        </div>
    </div>

    @include('foundation::admin.system.information._includes.php-extensions')
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
