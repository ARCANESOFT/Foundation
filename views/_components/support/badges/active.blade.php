<?php
/**
 * @var  boolean                                $value
 * @var  boolean                                $icon
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 */
$attributes = $attributes->merge([
    'class' => 'badge border text-muted '.($value ? 'border-success' : 'border-secondary'),
])
?>

@if($icon)
    <span {{$attributes}} title="@lang($value ? 'Activated' : 'Deactivated')" data-toggle="tooltip">
        <i class="fa fa-fw {{ $value ? 'fa-check text-success' : 'fa-ban text-secondary' }}"></i>
    </span>
@else
    <span {{$attributes}}>
        <i class="fa fa-fw {{ $value ? 'fa-check text-success' : 'fa-ban text-secondary' }} mr-1"></i>
        @lang($value ? 'Activated' : 'Deactivated')
    </span>
@endif

