@section('header')
    <i class="fa fa-fw fa-info-circle"></i> System <small>Information</small>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('foundation::system.information._includes.application')
        </div>
        <div class="col-md-4">
            @include(Arcanesoft\Foundation\ViewComposers\System\ServerRequirementsComposer::VIEW_NAME)
        </div>
        <div class="col-md-4">
            @include(Arcanesoft\Foundation\ViewComposers\System\FoldersPermissionsComposer::VIEW_NAME)
        </div>
    </div>

    @include('foundation::system.information._includes.php-env')
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
