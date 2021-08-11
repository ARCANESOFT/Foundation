<?php
/**
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  string                                 $type
 */
$attributes = $attributes
    ->except(['type'])
    ->class([
        'badge',
        'border',
        'border-'.$type,
        'text-muted',
    ])
;
?>
<span {{ $attributes }}>{{ $slot }}</span>
