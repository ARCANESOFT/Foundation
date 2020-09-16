<header class="page-header p-3">
    <h1 class="page-title">
        @yield('page-title', 'Default title')
    </h1>

    <nav aria-label="breadcrumb" class="breadcrumb-container">
        {{ breadcrumbs()->render('foundation') }}
    </nav>
</header>
