<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{ seo_helper()->renderHtml() }}
    {{ Html::style(mix('assets/css/admin.css')) }}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ Html::script('assets/js/vendors/pace.min.js') }}
    <!--[if lt IE 9]>
    {{ Html::script('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }}
    {{ Html::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}
    <![endif]-->
    @yield('head')
</head>
<body class="fixed sidebar-mini hold-transition {{ config('arcanesoft.foundation.skin', 'skin-purple') }}">
    <div id="app" class="wrapper">
        @include('foundation::admin._template.header')
        @include(Arcanesoft\Foundation\ViewComposers\SidebarComposer::VIEW)

        {{-- Content Wrapper. Contains page content --}}
        <main class="content-wrapper">
            {{-- Content Header (Page header) --}}
            <section class="content-header">
                <h1>@yield('header')</h1>

                {!! breadcrumbs()->render('foundation') !!}
            </section>

            {{-- Main content --}}
            <section class="content">
                @includeWhen(notify()->ready(), 'foundation::admin._template.notifications')

                @yield('content')
            </section>
        </main>

        @include('foundation::admin._template.footer')

        {{-- Control Sidebar --}}
        {{-- @include('foundation::admin._template.sidebar-alt') --}}

        @yield('modals')
    </div>

    {{-- Scripts --}}
    {{ Html::script(mix('assets/js/manifest.js')) }}
    {{ Html::script(mix('assets/js/vendors.js')) }}
    {{ Html::script(mix('assets/js/admin.js')) }}

    @yield('scripts')
</body>
</html>
