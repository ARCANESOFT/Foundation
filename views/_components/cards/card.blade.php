<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Cards\CardComponent
 *
 * @var Illuminate\View\ComponentAttributeBag  $attributes
 */
$attributes = $attributes
    ->class([
        'card',
        'card-borderless',
        'shadow-sm',
    ])
;
?>
<div {{ $attributes }}>{{ $slot }}</div>
