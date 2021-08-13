<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Cards\FooterComponent
 *
 * @var Illuminate\View\ComponentAttributeBag  $attributes
 */
$attributes = $attributes
    ->class([
        'card-footer',
        'p-3',
        'd-flex justify-content-end btn-separated' => $attributes->has('actions'),
    ])
    ->except(['actions'])
;
?>
<div {{ $attributes }}>{{ $slot }}</div>
