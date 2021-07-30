<?php
/** @var  Illuminate\View\ComponentAttributeBag  $attributes */
$attributes = $attributes
    ->except(['type', 'name', 'id', 'value'])
    ->class(['form-control'])
;
?>
<input type="password" name="{{ $name }}" id="{{ $id }}" {{ $attributes }}/>
