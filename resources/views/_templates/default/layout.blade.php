<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Foundation</title>
</head>
<body>
    @include('foundation::_templates.default.navigation')

    @yield('content')

    @include('foundation::_templates.default.footer')
    @yield('scripts')
</body>
</html>
