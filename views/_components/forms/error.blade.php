<?php
/** @var  Illuminate\View\ComponentAttributeBag  $attributes */
$attributes = $attributes
    ->merge([
        'role' => 'alert',
    ])
    ->class(['invalid-feedback'])
;
?>
@error($name, $bag)
<span {{ $attributes }}>{{ $slot->isEmpty() ? $message : $slot }}</span>
@enderror
