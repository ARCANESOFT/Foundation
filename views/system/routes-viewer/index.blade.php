<?php /** @var  Arcanedev\RouteViewer\Entities\Route[]  $routes */ ?>
<x-arc:layout>
    @section('page-title')
        <i class="fas fa-fw fa-map-signs"></i> @lang('Routes Viewer')
    @endsection

    <v-datatable
        name="routes-datatable"
        url="{{ route('admin::system.routes-viewer.datatable') }}"/>
</x-arc:layout>
