@section('header')
    <i class="fa fa-fw fa-info-circle"></i> Information <small></small>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include(Arcanesoft\Foundation\ViewComposers\System\ApplicationInfoComposer::VIEW)
        </div>
        <div class="col-md-4">
            @include(Arcanesoft\Foundation\ViewComposers\System\ServerRequirementsComposer::VIEW)
            @include(Arcanesoft\Foundation\ViewComposers\System\FoldersPermissionsComposer::VIEW)
        </div>
        <div class="col-md-4">
            @include(Arcanesoft\Foundation\ViewComposers\System\PhpInfoComposer::VIEW)
        </div>
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
