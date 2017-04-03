<ul class="sidebar-menu">
    <li class="header">{{ trans('foundation::navigation.sidebar.main-navigation') }}</li>
    @each('foundation::admin._composers.sidebar.item', $sidebarItems, 'item')
</ul>
