<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {!! seo_helper()->render() !!}
    {{ Html::style('vendor/foundation/css/app.css') }}

    {{-- CSRF Token --}}
    @include('foundation::admin._template.csrf-token')
    {{ Html::script('vendor/foundation/js/vendors/pace.min.js') }}
    <!--[if lt IE 9]>
    {{ Html::script('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }}
    {{ Html::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}
    <![endif]-->
    @yield('head')
</head>
<body class="fixed sidebar-mini skin-purple hold-transition">
    <div id="app" class="wrapper">
        @include('foundation::admin._template.header')

        @include('foundation::admin._template.sidebar-main')

        {{-- Content Wrapper. Contains page content --}}
        <main class="content-wrapper">
            {{-- Content Header (Page header) --}}
            <section class="content-header">
                <h1>@yield('header')</h1>

                {!! breadcrumbs()->render('foundation') !!}
            </section>

            {{-- Main content --}}
            <section class="content">
                @if (notify()->ready())
                    @include('foundation::admin._template.notifications')
                @endif

                @yield('content')
            </section>
        </main>

        @include('foundation::admin._template.footer')

        {{-- Control Sidebar --}}
        {{-- @include('foundation::admin._template.sidebar-alt') --}}

        @yield('modals')
    </div>

    {{ Html::script('vendor/foundation/js/vendors.js') }}
    {{ Html::script('vendor/foundation/js/app.js') }}
    @yield('scripts')
</body>
</html>