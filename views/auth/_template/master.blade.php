<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Auth') | {{ config('app.name') }}</title>
    <meta name="description" content="">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ mix('css/arcanesoft.css', 'assets') }}">

    @stack('head')
</head>
<body class="page auth-page h-100" data-skin-mode="light">
    <div id="app" class="d-flex flex-column h-100">
        <header class="text-center py-4">
            <a href="{{ route('public::index') }}" class="d-inline-block">
                <img src="{{ asset('assets/svg/arcanesoft/logo.svg') }}" alt="{{ config('app.name') }}"
                     role="presentation" width="72" height="72">
            </a>
        </header>

        <main role="main" class="d-flex align-items-center flex-grow-1">
            <div class="container">
                @yield('content')
            </div>
        </main>

        <footer class="mt-4">
            <p class="py-3 mb-0 text-center text-muted">
                {{ config('app.name') }} &copy; - {{ Arcanesoft\Foundation\Support\Date::since('2020') }} - @lang('All rights reserved')
            </p>
        </footer>
    </div>

    <script src="{{ mix('js/arcanesoft.js', 'assets') }}"></script>
    @stack('scripts')
</body>
</html>
