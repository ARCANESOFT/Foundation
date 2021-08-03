<?php
/** @var  Illuminate\View\ComponentAttributeBag  $attributes */
$attributes = $attributes
    ->merge([
        'type' => 'button',
        'data-bs-dismiss' => 'modal',
    ])
    ->class(['btn', 'btn-light'])
;
?>
<button {{ $attributes }}>@lang('Cancel')</button>
