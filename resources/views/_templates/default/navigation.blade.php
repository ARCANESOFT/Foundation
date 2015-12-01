{{-- Header Navbar --}}
<nav class="navbar navbar-static-top" role="navigation">
    {{-- Sidebar toggle button --}}
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>

    {{-- Navbar Right Menu --}}
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            {{-- Messages --}}
            @include('foundation::_templates.default.navigation.messages')
            {{-- Notifications --}}
            @include('foundation::_templates.default.navigation.notifications')
            {{-- Tasks --}}
            @include('foundation::_templates.default.navigation.tasks')
            {{-- User Account --}}
            @include('foundation::_templates.default.navigation.user-menu')
            {{-- Control Sidebar Toggle Button --}}
            <li>
                <a href="javascript:void(0);" data-toggle="control-sidebar">
                    <i class="fa fa-gears"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>
