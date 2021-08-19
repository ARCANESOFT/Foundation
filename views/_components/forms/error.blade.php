<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\ErrorComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\HtmlString          $slot
 */
$attributes = $attributes
    ->merge([
        'role' => 'alert',
    ])
    ->class([
        'invalid-feedback',
    ])
;
?>
@error($name, $bag)
<span {{ $attributes }}>{{ $slot->isEmpty() ? $message : $slot }}</span>
@enderror
