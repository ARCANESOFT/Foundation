@extends(arcanesoft\foundation()->template())

<?php /** @var  Arcanedev\RouteViewer\Entities\Route[]  $routes */ ?>

@section('page-title')
    <i class="fas fa-fw fa-map-signs"></i> @lang('Routes Viewer')
@endsection

@section('content')
    <v-datatable name="{{ Arcanesoft\Foundation\System\Views\Components\RoutesDatatable::NAME }}"></v-datatable>
@endsection
