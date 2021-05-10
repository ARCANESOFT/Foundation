<?php /** @var  \Arcanesoft\Foundation\Helpers\Sidebar\Manager  $sidebar */ ?>
<aside id="sidebar-container" class="sidebar-container">
    <nav id="sidebar-nav-container" class="sidebar-nav-container">
        @foreach($sidebar->items() as $sidebarItem)
            <?php /** @var  \Arcanesoft\Foundation\Helpers\Sidebar\Item  $sidebarItem */ ?>
            @if ($sidebarItem->canSee())
            <div class="d-flex flex-column nav-menu">
                {{-- HEADER --}}
                @if ($sidebarItem->hasChildren())
                    <div class="nav-menu-header" id="nav-menu-header-{{ $loop->iteration }}">
                        <a class="nav-menu-link no-underline d-flex align-items-center {{ $sidebarItem->active('', 'collapsed') }}"
                           aria-expanded="{{ $sidebarItem->active('true', 'false') }}"
                           role="button" data-bs-toggle="collapse"
                           data-bs-target="#menu-{{ $loop->iteration }}"
                           aria-controls="menu-{{ $loop->iteration }}">
                            {{ $sidebarItem->icon('me-2') }} <span>{{ $sidebarItem->title }}</span>
                        </a>
                    </div>
                    <div class="nav-sub-menu collapse {{ $sidebarItem->active('show') }}"
                         id="menu-{{ $loop->iteration }}"
                         aria-labelledby="nav-menu-header-{{ $loop->iteration }}"
                         data-bs-parent="#sidebar-nav-container">
                        <div class="d-flex flex-column nav-sub-menu-links">
                            @foreach($sidebarItem->children as $childItem)
                                <?php /** @var  \Arcanesoft\Foundation\Helpers\Sidebar\Item  $childItem */ ?>
                                @if ($childItem->canSee())
                                <a href="{{ $childItem->url }}" class="nav-menu-link no-underline d-flex align-items-center {{ $childItem->active() }}">
                                    {{ $childItem->icon('me-2') }} <span>{{ $childItem->title }}</span>
                                </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="nav-menu-header" id="nav-menu-header-{{ $loop->iteration }}">
                        <a href="{{ $sidebarItem->url }}" class="nav-menu-link no-underline d-flex align-items-center {{ $sidebarItem->active() }}">
                            {{ $sidebarItem->icon('me-2') }} <span>{{ $sidebarItem->title }}</span>
                        </a>
                    </div>
                @endif
            </div>
            @endif
        @endforeach
    </nav>
</aside>
