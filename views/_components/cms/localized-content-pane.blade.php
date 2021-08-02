<?php
/**
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  string                                 $locale
 * @var  bool                                   $active
 */
$attributes = $attributes
    ->merge([
        'id'              => $locale,
        'role'            => 'tabpanel',
        'aria-labelledby' => "{$locale}-tab",
    ])
    ->class([
        'tab-pane',
        'fade',
        'show',
        'active' => $active,
    ])
;
?>
<div {{ $attributes }}>{{ $slot }}</div>
