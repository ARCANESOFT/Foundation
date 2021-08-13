<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Cards\HeaderComponent
 *
 * @var Illuminate\View\ComponentAttributeBag  $attributes
 */
$attributes = $attributes
    ->class([
        'card-header',
        'p-3',
        'text-uppercase',
        'text-muted',
    ])
;
?>
<div {{ $attributes }}>{{ $slot }}</div>
