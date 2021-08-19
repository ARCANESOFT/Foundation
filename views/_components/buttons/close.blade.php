<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Buttons\CloseComponent
 *
 * @var Illuminate\View\ComponentAttributeBag  $attributes
 */
$attributes = $attributes
    ->merge([
        'type' => 'button',
        'aria-label' => __('Close'),
    ])
    ->class([
        'btn-close',
    ])
;
?>
<button {{ $attributes }}></button>
