<?php
/**
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  string                                 $for
 * @var  string                                 $label
 */
$attributes = $attributes
    ->merge(['for' => $for])
    ->class(['form-label', 'font-weight-light', 'text-uppercase', 'text-muted']);
?>
<label {{ $attributes }}>{{ $slot->isEmpty() ? __($label) : $slot }}</label>
