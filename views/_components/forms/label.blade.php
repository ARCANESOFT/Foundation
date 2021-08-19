<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\LabelComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\HtmlString          $slot
 * @var  string                                 $for
 * @var  string                                 $label
 */
$attributes = $attributes
    ->merge(['for' => $for])
    ->class([
        'form-label',
        'font-weight-light',
        'text-uppercase',
        'text-muted',
    ])
;
?>
<label {{ $attributes }}>{{ $slot->isEmpty() ? __($label) : $slot }}</label>
