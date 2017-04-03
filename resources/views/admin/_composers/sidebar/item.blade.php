<?php /** @var  \Arcanesoft\Sidebar\Entities\Item  $item */ ?>
<li class="{{ trim($item->childrenClass().' '.$item->activeClass('active open')) }}">
    @if ($item->hasChildren())
        <a href="javascript:void(0);">
            <i class="{{ $item->icon() }}"></i> <span>{{ $item->title() }}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            @each('foundation::admin._composers.sidebar.item', $item->children(), 'item')
        </ul>
    @else
        <a href="{{ $item->url() }}">
            <i class="{{ $item->icon() }}"></i> <span>{{ $item->title() }}</span>
        </a>
    @endif
</li>
