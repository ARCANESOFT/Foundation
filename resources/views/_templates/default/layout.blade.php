<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ARCANESOFT Foundation | Dashboard v2</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {!! Html::style('vendor/foundation/css/foundation.min.css') !!}
    {!! Html::style('vendor/foundation/css/style.min.css') !!}
    <!--[if lt IE 9]>
        {!! Html::script('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') !!}
        {!! Html::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') !!}
    <![endif]-->
</head>
<body class="fixed sidebar-mini skin-purple hold-transition">
    <div class="wrapper">
        @include('foundation::_templates.default.header')

        @include('foundation::_templates.default.sidebar-main')

        <!-- Content Wrapper. Contains page content -->
        <main class="content-wrapper">
            {{-- Content Header (Page header) --}}
            <section class="content-header">
                <h1>@yield('header')</h1>

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            {{-- Main content --}}
            <section class="content">
                @yield('content')
            </section>
        </main>

        @include('foundation::_templates.default.footer')

        {{-- Control Sidebar --}}
        @include('foundation::_templates.default.sidebar-alt')
    </div>

    {!! Html::script('vendor/foundation/js/vendors.min.js') !!}
    {!! Html::script('vendor/foundation/js/foundation.min.js') !!}
    {!! Html::script('vendor/foundation/js/app.min.js') !!}
    @yield('scripts')
</body>
</html>
