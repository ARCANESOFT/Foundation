<?php
/**
 * @var  int                                    $value
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 */
$hasPositiveValue = $value > 0;
$attributes = $attributes
    ->class([
        'badge',
        'rounded-pill',
        'text-muted border',
        'border-info' => $hasPositiveValue,
        'border-muted' => ! $hasPositiveValue,
    ])
;
?>
<span {{ $attributes }}>{{ $value }}</span>
