<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Support\Badges\CountComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  int                                    $value
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
