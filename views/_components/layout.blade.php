<?php

use Arcanesoft\Foundation\Helpers\Sidebar\Manager;

/**  @var Illuminate\View\ComponentAttributeBag  $attributes */
$attributes = $attributes
    ->merge([
        'data-skin-mode'       => session()->get('foundation.skin.mode', 'light'),
        'data-sidebar-visible' => Manager::isVisible() ? 'true' : 'false',
    ])
    ->class(['h-100', 'p-0'])
;
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', Arcanesoft\Foundation\Cms\Cms::getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset(mix('css/arcanesoft.css', 'assets')) }}">
    @stack('head')
</head>
<body {{ $attributes }}>
    {{-- APP CONTAINER --}}
    <div id="arcanesoft" class="app-container h-100">
        @include('foundation::_components.layout.navbar')

        @include(Arcanesoft\Foundation\Core\Views\Composers\SidebarComposer::VIEW)

        <main class="main-container d-flex flex-column h-100">
            <div class="page-container flex-grow-1">
                @include('foundation::_components.layout.page-header')

                <section class="content-wrapper p-3">
                    @stack('content-nav')

                    @include(Arcanesoft\Foundation\Core\Views\Composers\NotificationsComposer::VIEW)

                    @include(Arcanesoft\Foundation\Core\Views\Composers\MetricsComposer::VIEW)

                    {{ $slot }}
                </section>
            </div>

            @include('foundation::_components.layout.footer')
        </main>

        <v-toasts-manager></v-toasts-manager>
    </div>

    {{-- MODALS --}}
    @stack('modals')

    {{-- SCRIPTS --}}
    <script src="{{ asset(mix('js/arcanesoft.js', 'assets')) }}"></script>
    @stack('scripts')
    <script defer>ARCANESOFT.run()</script>
</body>
</html>
