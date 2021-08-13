<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Cards\BodyComponent
 *
 * @var Illuminate\View\ComponentAttributeBag  $attributes
 */
$attributes = $attributes
    ->class([
        'card-body',
        'p-3',
    ])
;
?>
<div {{ $attributes }}>{{ $slot }}</div>
