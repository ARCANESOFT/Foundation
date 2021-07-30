<?php
/** @var  Illuminate\View\ComponentAttributeBag  $attributes */
$attributes = $attributes
    ->except(['name', 'id', 'rows'])
    ->class(['form-control'])
;
?>
<textarea
    name="{{ $name }}" id="{{ $id }}" rows="{{ $rows }}" {{ $attributes }}
>{{ old($name, $slot) }}</textarea>
