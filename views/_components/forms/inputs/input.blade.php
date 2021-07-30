<?php
/** @var  Illuminate\View\ComponentAttributeBag  $attributes */
$attributes = $attributes
    ->except(['type', 'name', 'id', 'value'])
;
?>
<input
    type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ old($name, $value) }}" {{ $attributes }}
/>
