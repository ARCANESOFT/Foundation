<?php
/** @var Illuminate\View\ComponentAttributeBag $attributes */
$attributes = $attributes
    ->class([
        'card-footer',
        'p-3',
        'd-flex'              => $attributes->has('actions'),
        'justify-content-end' => $attributes->has('actions'),
        'btn-seperated'       => $attributes->has('actions'),
    ])
    ->except(['actions'])
;
?>
<div {{ $attributes }}>{{ $slot }}</div>
