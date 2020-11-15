<?php
/**
 * @var  int                                    $value
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 */
$attributes = $attributes->merge([
    'class' => 'badge rounded-pill text-muted border '.($value > 0 ? 'border-info' : 'border-muted'),
]);
?>
<span {{ $attributes }}>{{ $value }}</span>
