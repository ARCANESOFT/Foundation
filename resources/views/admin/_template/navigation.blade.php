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
            @include('foundation::admin._template.navigation.messages')
            {{-- Notifications --}}
            @include('foundation::admin._template.navigation.notifications')
            {{-- Tasks --}}
            @include('foundation::admin._template.navigation.tasks')

            {{-- User Account --}}
            @if (view()->exists('auth::admin._partials.navigation.user-menu'))
                @include('auth::admin._partials.navigation.user-menu')
            @endif

            {{-- Control Sidebar Toggle Button --}}
            <li>
                <a href="javascript:void(0);" data-toggle="control-sidebar">
                    <i class="fa fa-gears"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>
