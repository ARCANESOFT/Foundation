{{-- Header Navbar --}}
<nav class="navbar navbar-static-top" role="navigation">
    {{-- Sidebar toggle button --}}
    <a href="javascript:void(0);" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>

    {{-- Navbar Right Menu --}}
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li>
                <a href="{{ route('public::home') }}" target="_blank">
                    <i class="fa fa-fw fa-home"></i>
                </a>
            </li>
            {{-- Messages --}}
            @include('foundation::_template.navigation.messages')
            {{-- Notifications --}}
            @include('foundation::_template.navigation.notifications')
            {{-- Tasks --}}
            @include('foundation::_template.navigation.tasks')
            {{-- User Account --}}
            @include('auth::foundation._partials.navigation.user-menu')
            {{-- Control Sidebar Toggle Button --}}
            <li>
                <a href="javascript:void(0);" data-toggle="control-sidebar">
                    <i class="fa fa-gears"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>
