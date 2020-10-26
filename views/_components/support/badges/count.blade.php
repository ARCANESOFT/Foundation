<?php
/**
 * @var  int                                    $value
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 */
$attributes = $attributes->merge([
    'class' => 'badge rounded-pill border '.($value > 0 ? 'border-info text-info' : 'text-muted'),
]);
?>
<span {{ $attributes }}>{{ $value }}</span>
